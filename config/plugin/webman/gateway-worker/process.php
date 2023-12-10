<?php

use Webman\GatewayWorker\Gateway;
use Webman\GatewayWorker\BusinessWorker;
use Webman\GatewayWorker\Register;

return [
    'gateway' => [
        'handler'     => Gateway::class,
        'listen'      => 'websocket://0.0.0.0:8783',
        'count'       => cpu_count(),
        'reloadable'  => false,
        'constructor' => ['config' => [
            'lanIp'           => '127.0.0.1',
            'startPort'       => 2300,
            'pingInterval'    => 25,
            'pingData'        => '{"type":"ping"}',
            'registerAddress' => '127.0.0.1:12306',
            'onConnect' => function ($connection) {
                $connection->onWebSocketConnect = function ($connection, $header) {
                    /** 1. HTTP_ORIGIN 请求头合法性校验 */
                    // var_dump($_SERVER);
                    // 判断连接来源是否合法，不合法就关掉连接（Jmeter压测暂时注释掉）
                    if (!isset($_SERVER['HTTP_ORIGIN'])) {
                        echo ' [x] [ORIGIN合法检测] 未定义HTTP_ORIGIN ', "\n";
                        return $connection->close();
                    }

                    // 判断连接来源是满足条件，不合法就关掉连接
                    // if ($_SERVER['HTTP_ORIGIN'] != 'http://127.0.0.1:8783') {
                    if ($_SERVER['HTTP_ORIGIN'] != 'https://tinywan.com') {
                        echo ' [x] [ORIGIN合法检测] HTTP_ORIGIN不满足条件', "\n";
                        return $connection->close();
                    }
                    echo ' [x] [ORIGIN合法检测] HTTP_ORIGIN验证通过啦！！！', "\n";

                    /** 2. 认证签名校验 */
                    if (!isset($_GET['sign']) || !isset($_GET['ts'])) {
                        echo ' [x] [签名认证] 未携带签名或时间戳参数', "\n";
                        return $connection->close();
                    }

                    // 秘钥可以通过配置文件或者Redis读取
                    $secret = 'Tinywan2024';
                    $serverSign = sha1($_GET['ts'].'|'.$secret);
                    if ($_GET['sign'] != $serverSign) {
                        echo ' [x] [签名认证] 签名认证失败', "\n";
                        return $connection->close();
                    }
                    echo ' [x] [签名认证] 验证通过啦！！！！！！！！', "\n";
                    return true;
                };
            },
        ]]
    ],
    'worker' => [
        'handler'     => BusinessWorker::class,
        'count'       => cpu_count()*2,
        'constructor' => ['config' => [
            'eventHandler'    => plugin\webman\gateway\Events::class,
            'name'            => 'ChatBusinessWorker',
            'registerAddress' => '127.0.0.1:12306',
        ]]
    ],
    'register' => [
        'handler'     => Register::class,
        'listen'      => 'text://127.0.0.1:12306',
        'count'       => 1, // Must be 1
        'constructor' => []
    ],
];
