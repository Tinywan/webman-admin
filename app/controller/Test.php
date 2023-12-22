<?php
declare(strict_types=1);

namespace app\controller;


class Test
{
    /**
     * @desc redisJson
     * @author Tinywan(ShaoBo Wan)
     */
    public function redisJson()
    {
        $redisClient = new \Redis();
        $redisClient->connect('192.168.13.168',63789);
        $reJSON = \Redislabs\Module\ReJSON\ReJSON::createWithPhpRedis($redisClient);
        $res = $reJSON->set('Tinywan', '.', ['username'=>'Tinywan','age'=>25], 'NX');
        var_dump($res);
    }

    /**
     * @desc rediSearch
     * @author Tinywan(ShaoBo Wan)
     */
    public function rediSearch()
    {
        /** 创建Redis客户端 */
        $redis = (new \Ehann\RedisRaw\PhpRedisAdapter())->connect('192.168.13.168',63789);

        /** 创建数据模型与索引 */
        $bookIndex = new \Ehann\RediSearch\Index($redis);
//        $bookIndex->addTextField('title')
//            ->addTextField('author')
//            ->addNumericField('price')
//            ->addNumericField('stock')
//            ->addTextField('description')
//            ->create();
//
//        /** 添加文档 */
//        $bookIndex->add([
//            new \Ehann\RediSearch\Fields\TextField('title', '开源技术小栈RedisSearch系列教程'),
//            new \Ehann\RediSearch\Fields\TextField('author', 'Tinywan'),
//            new \Ehann\RediSearch\Fields\NumericField('price', 9.99),
//            new \Ehann\RediSearch\Fields\NumericField('stock', 2024),
//            new \Ehann\RediSearch\Fields\TextField('description', 'RedisSearch 是一个基于 Redis 的搜索引擎模块，它提供了全文搜索、索引和聚合功能。'),
//        ]);

        /** 搜索索引 */
        $result = $bookIndex->search('开源技术小栈RedisSearch系列教程');
        var_dump($result);
//        $result->count();     // Number of documents.
//        $result->documents(); // Array of matches.
//        // Documents are returned as objects by default.
        $firstResult = $result->documents()[0];
//        $firstResult->title;
//        $firstResult->author;
    }
}
