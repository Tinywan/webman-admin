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
use support\Log;
use support\Request;
use Tinywan\Captcha\Captcha;
use Tinywan\Captcha\Config;
use Tinywan\Jwt\JwtToken;
use Tinywan\Nacos\Exception\NacosAuthException;
use Tinywan\Nacos\Nacos;
use Tinywan\Nacos\Observer\ConcreteObserverA;
use Tinywan\Nacos\Observer\ConcreteObserverB;
use Tinywan\Nacos\Observer\ListenerSubject;
use Tinywan\Storage\Exception\StorageException;
use Tinywan\Storage\Storage;
use Tinywan\Support\Logger;
use Tinywan\Support\Str;
use Tinywan\Rpc\Client;

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
        $param = $request->post();
        try {
            Storage::config(Storage::MODE_OSS);
            $r = Storage::uploadBase64($param);
            var_dump($r);
            var_dump(Storage::getMessage());
        }catch (StorageException $exception) {
            return response_json(0,$exception->getMessage());
        }
        return response_json(0,'success');
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
//        $code = $request->get('code');
        // 验证通过
//       return response_json(0, 'ok', Captcha::base64());
//        $code = 'pfy3f';
//        $key = '$2y$10$imbrFN5G8Piw6GEtcuUCMemjAbkuj2HAsObu7I46mo0F6G55OMR3K';
//        var_dump(Captcha::check($code,$key));
//        $request = [
//            'class'   => 'User',
//            'method'  => 'get',
//            'args'    => [2022], // 100 是 $uid
//        ];
//        $client = new Client('tcp://127.0.0.1:9512');
//        $res = $client->request($request);

//        $client = stream_socket_client('tcp://127.0.0.1:9512');
//        $request = [
//            'class'   => 'User',
//            'method'  => 'get',
//            'args'    => [2022]
//        ];
//        fwrite($client, json_encode($request)."\n"); // text协议末尾有个换行符"\n"
//        $result = fgets($client, 10240000);
//        var_dump($result);

        $request = [
            'class'   => 'User',
            'method'  => 'get',
            'args'    => [2022]
        ];
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:9512']);
        $options = ['form_params' => $request];
        $resp = $client->get('/', $options);
        $content = $resp->getBody()->getContents();
        var_dump($content);
        return response_json(0, 'ok');
    }
}
