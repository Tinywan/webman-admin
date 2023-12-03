<?php

namespace plugin\webman\gateway;

use ErrorException;
use GatewayWorker\Lib\Gateway;
use Workerman\Worker;

class Events
{
    /**
     * @desc: 当客户端连接上gateway完成websocket握手时触发
     * @param Worker $worker
     * @throws ErrorException
     * @author Tinywan(ShaoBo Wan)
     */
    public static function onWorkerStart(Worker $worker)
    {
        set_error_handler(function ($severity, $message, $file, $line) use ($worker) {
            if (!(error_reporting() & $severity)) {
                return;
            }
            throw new \ErrorException($message, 0, E_ERROR, $file, $line);
        });
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
        try {
            $originMessage = json_decode($message, true);
            if (json_last_error() != JSON_ERROR_NONE) {
                Gateway::closeClient($clientId, broadcast_json(400, '无效的json数据'));
                return false;
            }
            // 被除数为0的异常
            $aa = 1/0;
            var_dump($aa);
        } catch (\Throwable $throwable) {
            return Gateway::sendToClient($clientId, broadcast_json(500, $throwable->getMessage()));
        }
        return Gateway::sendToClient($clientId, broadcast_json(200, '请求成功', $originMessage));
    }

    public static function onClose($client_id)
    {

    }

}
