<?php

namespace plugin\webman\gateway;

use GatewayWorker\Lib\Gateway;

class Events
{
    public static function onWorkerStart($worker)
    {

    }

    public static function onConnect($client_id)
    {

    }

    /**
     * @desc onMessage
     * @param string $clientId
     * @param string $message
     * @return false
     * @author Tinywan(ShaoBo Wan)
     */
    public static function onMessage(string $clientId, string $message): bool
    {
        $originMessage = json_decode($message, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            Gateway::closeClient($clientId, json_encode([
                'code' => 500,
                'msg' => '无效的json数据'
            ], JSON_UNESCAPED_UNICODE));
            return false;
        }
        return Gateway::sendToClient($clientId, json_encode([
            'code' => 200,
            'msg' => '请求发送成功',
            'data' => $originMessage
        ], JSON_UNESCAPED_UNICODE));
    }

    public static function onClose($client_id)
    {

    }

}
