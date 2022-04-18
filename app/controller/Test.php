<?php
/**
 * @desc 身份认证
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/19 16:55
 */

declare(strict_types=1);

namespace app\controller;

use app\common\validate\UnauthorizedValidate;
use app\common\validate\UserValidate;
use support\Request;

use think\facade\Db;
use Tinywan\Captcha\Config;
use Tinywan\Jwt\JwtToken;
use Tinywan\MeiliSearch;
use Tinywan\Nacos\Exception\NacosAuthException;
use Tinywan\Nacos\Nacos;
use Tinywan\Nacos\Observer\ConcreteObserverA;
use Tinywan\Nacos\Observer\ConcreteObserverB;
use Tinywan\Nacos\Observer\ListenerSubject;
use Tinywan\Soar\Soar;
use Tinywan\Storage\Exception\StorageException;
use Tinywan\Storage\Storage;
use Tinywan\Support\Logger;
use Tinywan\Support\Str;
use tinywan\Weather;
use function DI\create;

class Test
{
    public function validate(Request $request)
    {
        $data = [
            'name'  => 'Tinywan',
            'age'  => 24,
//            'email' => 'Tinywan@163.com'
        ];
        validate($data, UserValidate::class . '.issue');
//        $validate = new UserValidate();
//        if (false === $validate->check($data)) {
//            return 'fail, '.$validate->getError();
//        }
        return 'success';
    }

    public function jwt(Request $request)
    {
        $uid = JwtToken::getCurrentId();
        return response_json(0,'success',[
            'uid'=>$uid,
            'mobile'=>JwtToken::getExtendVal('mobile'),
            'Extend'=>JwtToken::getExtend(),
            'Exp'=>JwtToken::getTokenExp(),
        ]);
    }

    public function refreshToken(Request $request)
    {
        $accessToken = JwtToken::refreshToken();
        return response_json(0,'success',$accessToken);
    }

    /**
     * 异常测试
     * @param Request $request
     */
    public function exceptionHandler(Request $request)
    {
        $param = $request->get();
        validate($param, UnauthorizedValidate::class . '.issue');
        return response_json(0,'success');
    }

    /**
     * upload
     * @param Request $request
     */
    public function upload(Request $request)
    {
        try {
            Storage::config(Storage::MODE_OSS);
            $res = Storage::uploadFile();
        }catch (StorageException $exception) {
            return response_json(0,$exception->getMessage());
        }
        return response_json(0,'success',$res);
    }

    /**
     * upload
     * @param Request $request
     */
    public function nacos(Request $request)
    {
        $nacos = new Nacos();
        $dataId = 'qiniu.php';
        $group = 'DEFAULT_GROUP';
        $namespace = 'f49ab8b3-5ca5-46f9-ae7b-9eafbc708129';

        $content = $nacos->config->get($dataId, $group, $namespace);
        if (false === $content) {
            return response_json(0,$nacos->config->getMessage());
        }
        var_dump($content);
//        $contentMd5 = md5($content);
//        // 注册监听采用的是异步 Servlet 技术。注册监听本质就是带着配置和配置值的 MD5 值和后台对比。
//        // 如果 MD5 值不一致，就立即返回不一致的配置。如果值一致，就等待住 30 秒。返回值为空。
//
//        $response = $nacos->config->listen($dataId, $group, $contentMd5,$namespace);
//        if (false === $response) {
//            return response_json(0,$nacos->config->getMessage());
//        }
//        var_dump($response);
        return response_json(0,'nacos');
    }

    /**
     * log
     * @param Request $request
     */
    public function log(Request $request)
    {
//        $documents = Db::table('mall_goods')
//            ->field('goods_id id,goods_name,default_image')
//            ->limit(200)
//            ->select()
//            ->toArray();
            $config = [
                'url' => 'https://meilisearch.busionline.com/',
                'key' => '',
                'guzzle' => [
                    'headers' => [
                        'charset' => 'UTF-8',
                    ],
                    'timeout' => 20
                ],
            ];
            MeiliSearch::config($config);
//            $obj = MeiliSearch::search()->index('good_index_200')->search('蛋')->getRaw();
//            var_dump($obj);
         var_dump(MeiliSearch::getContainer()); // class DI\Container#101 (8) {}
        // Meili::getContainer() class DI\Container#101 (8)


//        $builder = new ContainerBuilder();
//        $container = $builder->build();
//        var_dump($container->has('conn'));
//        if (!$container->has('conn')) {
//            $container->set('conn',\DI\create(Connection::class));
//        }
//        $obj = $container->get('conn');
//        var_dump($obj->test());

//        $builder = new ContainerBuilder();
//        $container = $builder->build();
//        $container->set(\extend\map\MapInterface::class, $container);
//        var_dump($container);

        // 配置哪个 MapInterface PHP-DI 应该通过配置自动注入到 StoreService 中
//        $container->set(\extend\map\MapInterface::class, \DI\create(\extend\map\GoogleMap::class));
//        $storeService = $container->get(\extend\map\StoreService::class);
//        $res = $storeService->getStoreCoordinates(1);
//        var_dump($res);

        return response_json(0, 'ok');
    }

    public function json(Request $request)
    {
        static $pdo, $redis;
        // return json(['code' => 0, 'msg' => 'ok']);
        $host='127.0.0.1';
        $user='xx';
        $password='xxx';
        $dbName='xx';
        if (!$pdo) {
            $pdo=new \PDO("mysql:host=$host;dbname=$dbName",$user,$password,[\PDO::ATTR_PERSISTENT => true]);
        }

        $sql="select * from tests";
        $data=$pdo->query($sql)->fetch(\PDO::FETCH_ASSOC);

        //连接本地的 Redis 服务
        if (!$redis) {
            $redis = new \Redis();
            $redis->connect('127.0.0.1', 6379);
        }
        //设置 redis 字符串数据
        $redis->set("tutorial-name", "Redis tests");
        // 获取存储的数据并输出
        $data2 = ['fromredis'=>$redis->get("tutorial-name")];

        return json(array_merge($data2,$data));
    }
}
