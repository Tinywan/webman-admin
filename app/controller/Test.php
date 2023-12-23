<?php
declare(strict_types=1);

namespace app\controller;


use support\Redis;

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

    public function openai()
    {
        try {
            $yourApiKey = 'sb-0847b15ab5b63416f63aa8a4b99003dfad9f1516c0e2dabb';
            $client = \OpenAI::factory()
                ->withApiKey($yourApiKey)
//            ->withBaseUri('api.openai.com/v1')
                ->withBaseUri('api.openai-sb.com/v1')
                ->withHttpClient($client = new \GuzzleHttp\Client([]))
                ->withStreamHandler(fn (\Psr\Http\Message\RequestInterface $request): \Psr\Http\Message\ResponseInterface => $client->send($request, [
                    'stream' => true // Allows to provide a custom stream handler for the http client.
                ]))->make();
//        $result = $client->chat()->create([
//            'model' => 'gpt-3.5-turbo-0613',
//            'messages' => [
//                ['role' => 'user', 'content' => 'PHP语言是什么？'],
//            ],
//        ]);
//
//        var_dump($result->choices[0]->message->content); // Hello! How can I assist you today?


            $response = $client->embeddings()->create([
                'model' => 'text-embedding-ada-002',
                'input' => 'The food was delicious and the waiter...',
                'encodding_format' => 'float'
            ]);

//            var_dump($response->object);
        foreach ($response->embeddings as $embedding) {
//            var_dump($embedding->object); // 'embedding'
            var_dump($embedding->embedding); // [0.018990106880664825, -0.0073809814639389515, ...]
//            echo $embedding->index . '\r\n'; // 0
        }

//        $response->usage->promptTokens; // 8,
//        $response->usage->totalTokens; // 8
//
//        $response->toArray(); // ['data' => [...], ...]
//        var_dump(111111111);
//        $index = "gtp-embedding-2024";
//        Redis::rawCommand('FT.INFO', $index);
//
//        Redis::rawCommand('FT.CREATE', $index, 'on', 'JSON', 'PREFIX', '1', "$index:",
//            'SCHEMA','$.text_embedding', 'AS', 'text_embedding', 'VECTOR', 'FLAT', '6', 'DIM', '1536', 'DISTANCE_METRIC', 'COSINE', 'TYPE', 'FLOAT32');
//        $result = $client->chat()->create([
//            'model' => 'gpt-3.5',
//            'messages' => [
//                ['role' => 'user', 'content' => 'Hello!'],
//            ],
//        ]);
//
//        echo $result->choices[0]->message->content; // Hello! How can I assist you today?
        }catch (\Throwable $throwable) {
            var_dump('异常错误 '.$throwable->getMessage());
        }

    }
}
