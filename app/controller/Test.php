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
        $redisClient->connect('192.168.13.168', 63789);
        $reJSON = \Redislabs\Module\ReJSON\ReJSON::createWithPhpRedis($redisClient);
        $res = $reJSON->set('Tinywan', '.', ['username' => 'Tinywan', 'age' => 25], 'NX');
        var_dump($res);
    }

    /**
     * @desc rediSearch
     * @author Tinywan(ShaoBo Wan)
     */
    public function rediSearch()
    {
        /** 创建Redis客户端 */
        $redis = (new \Ehann\RedisRaw\PhpRedisAdapter())->connect('192.168.13.168', 63789);

        /** 创建数据模型与索引 */
        $bookIndex = new \Ehann\RediSearch\Index($redis);
        $bookIndex->addTextField('title')
            ->addTextField('author')
            ->addNumericField('price')
            ->addNumericField('stock')
            ->addTextField('description')
            ->create();

        /** 添加文档 */
        $bookIndex->add([
            new \Ehann\RediSearch\Fields\TextField('title', '开源技术小栈RedisSearch系列教程'),
            new \Ehann\RediSearch\Fields\TextField('author', 'Tinywan'),
            new \Ehann\RediSearch\Fields\NumericField('price', 9.99),
            new \Ehann\RediSearch\Fields\NumericField('stock', 2024),
            new \Ehann\RediSearch\Fields\TextField('description', 'RedisSearch 是一个基于 Redis 的搜索引擎模块，它提供了全文搜索、索引和聚合功能。'),
        ]);

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
            $apiKey = 'xxxxxxxxxxxxxxxx';
            $client = \OpenAI::factory()
                ->withApiKey($apiKey)
                ->withBaseUri('api.openai.com/v1')
                ->withHttpClient($client = new \GuzzleHttp\Client([]))
                ->withStreamHandler(fn(\Psr\Http\Message\RequestInterface $request): \Psr\Http\Message\ResponseInterface => $client->send($request, [
                    'stream' => true // Allows to provide a custom stream handler for the http client.
                ]))->make();
////            $result = $client->chat()->create([
////                'model' => 'gpt-3.5-turbo-0613',
////                'messages' => [
////                    ['role' => 'user', 'content' => 'Tinywan 程序员是谁？'],
////                ],
////            ]);
////            echo '[开源技术小栈响应]：'.$result->choices[0]->message->content;
////            return response_json(0,'success');
            /** TODO 1、利用ChatGTP Embeddings功能，将文本转换为向量 */
//            $input = '开源技术小栈';
            $input = 'Tinywan 个人主页：https://www.tinywan.com';
            $response = $client->embeddings()->create([
                'model' => 'text-embedding-ada-002',
                'input' => $input,
                'encodding_format' => 'float' // 向量是一组多维的数组，数组元素为 float 类型数据。
            ]);

            /** TODO 2、将文本向量并存储到Redis中，实现向量相似度搜索 */
            $textEmbeddingVector = $response['data'][0]['embedding'];
            $indexName = 'tinywan:embedding:2024';
            try {
                $indexExist = Redis::rawCommand('FT.INFO', $indexName);
            } catch (\Throwable $e) {
                $indexExist = false;
            }

            /** TODO 3、索引不存在，创建索引 */
            if (!$indexExist) {
                Redis::rawCommand('FT.CREATE', $indexName, 'on', 'JSON', 'PREFIX', '1', "$indexName:", 'SCHEMA',
                    '$.text_embedding', 'AS', 'text_embedding', 'VECTOR', 'FLAT', '6', 'DIM', '1536', 'DISTANCE_METRIC', 'COSINE', 'TYPE', 'FLOAT32');
            }
            /** TODO 4、添加向量存储 */
            $embeddingKey = 'tinywan:embedding:2024:' . time();
            $embeddingValue = [
                'key' => $embeddingKey,
                'content' => $input,
                'text_embedding' => $textEmbeddingVector
            ];
            Redis::rawCommand('JSON.SET', $embeddingKey, '$', json_encode($embeddingValue, JSON_UNESCAPED_UNICODE));
        } catch (\Throwable $throwable) {
            var_dump('异常错误 ' . $throwable->getMessage() . '|' . $throwable->getFile() . '|' . $throwable->getLine());
            return json([]);
        }
        return json([]);
    }

    public function openaiSearch()
    {
        try {
            $apiKey = 'xxxxxxxxxxxxx';
            $client = \OpenAI::factory()
                ->withApiKey($apiKey)
                ->withBaseUri('api.openai.com/v1')
                ->withHttpClient($client = new \GuzzleHttp\Client([]))
                ->withStreamHandler(fn(\Psr\Http\Message\RequestInterface $request): \Psr\Http\Message\ResponseInterface => $client->send($request, [
                    'stream' => true
                ]))->make();

            /** TODO 1、利用ChatGTP Embeddings功能，将文本转换为向量 */
            $response = $client->embeddings()->create([
                'model' => 'text-embedding-ada-002',
                'input' => '开源技术小栈',
                'encodding_format' => 'float' // 向量是一组多维的数组，数组元素为 float 类型数据。
            ]);
            $embedding = $response['data'][0]['embedding'];
            $blob = '';
            foreach ($embedding as $value) {
                $blob .= pack('f', $value);
            }
            $indexName = 'tinywan:embedding:2024';
            $count = 10;
            $redisResult = Redis::rawCommand('FT.SEARCH', $indexName, '*=>[KNN ' .
                $count . ' @text_embedding $blob]', 'PARAMS', '2', 'blob', $blob, 'SORTBY', '__text_embedding_score', 'DIALECT', '2');
            /** TODO 2、查询向量分数最高的1条数据 */
            if (!isset($redisResult[2][3])) {
                return json(['content' => []]);
            }
            /** TODO 3、返回精准查询内容 */
            $resultArr = json_decode($redisResult[2][3], true);
        } catch (\Throwable $throwable) {
            var_dump('异常错误 ' . $throwable->getMessage() . '|' . $throwable->getFile() . '|' . $throwable->getLine());
            return json([]);
        }
        return json(['content' => $resultArr['content']]);
    }
}
