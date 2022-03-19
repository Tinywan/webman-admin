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
use Tinywan\Jwt\JwtToken;
use Tinywan\Nacos\Exception\NacosAuthException;
use Tinywan\Nacos\Nacos;
use Tinywan\Nacos\Observer\ConcreteObserverA;
use Tinywan\Nacos\Observer\ConcreteObserverB;
use Tinywan\Nacos\Observer\ListenerSubject;
use Tinywan\Storage\Exception\StorageException;
use Tinywan\Storage\Storage;

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
        echo 1;
        echo 2;
        echo 3;
//        $uid = JwtToken::getCurrentId();
//        return response_json(0,'success',[
//            'uid'=>$uid,
//            'mobile'=>JwtToken::getExtendVal('mobile'),
//        ]);
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
            Storage::config(); // 初始化。 默认为本地存储：local
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
     * 观察者
     * @param Request $request
     */
    public function observer(Request $request)
    {
        $subject = new ListenerSubject();
        $o1 = new ConcreteObserverA();
        $subject->attach($o1);;
        $o2 = new ConcreteObserverB();
        $subject->attach($o2);

        $subject->state = rand(0, 10);
        // 查询缓存本地缓存是否有更新
        $subject->someBusinessLogic();
        $subject->someBusinessLogic();
        $snapshotFile = config_path() . DIRECTORY_SEPARATOR . 'redis.php';
        $file = new \SplFileInfo($snapshotFile);
        if (!is_dir($file->getPath())) {
            mkdir($file->getPath(), 0777, true);
        }
        return response_json(0,'success');
    }
}
