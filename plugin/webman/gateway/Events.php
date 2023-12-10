<?php

namespace plugin\webman\gateway;

use app\common\model\MessageModel;
use app\common\validate\MessageFormatValidate;
use ErrorException;
use GatewayWorker\Lib\Gateway;
use support\Log;
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

    /**
     * @desc: 当客户端连接上gateway完成websocket握手时触发
     * @param string $clientId
     * @param array $data
     * @return bool
     * @author Tinywan(ShaoBo Wan)
     */
    public static function onWebSocketConnect(string $clientId, array $data): bool
    {
        try {
            $_SESSION['client_ip'] = get_client_real_ip($data['server']['HTTP_X_FORWARDED_FOR'] ?? $data['server']['HTTP_REMOTEIP'] ?? '127.0.0.1');
            $_SESSION['browser'] = isset($data['server']['HTTP_USER_AGENT']) ? get_client_browser($data['server']['HTTP_USER_AGENT']) : '未知';
        } catch (\Throwable $e) {
            Log::error('[onWebSocketConnect] ' . $e->getMessage() . '|' . $e->getFile() . '|' . $e->getLine());
            return Gateway::sendToCurrentClient(broadcast_json(500, $e->getMessage()));
        }
        return true;
    }

    /**
     * @desc 当客户端发来数据后触发的回调函数
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
            if (!is_array($originMessage)) {
                Gateway::closeClient($clientId, broadcast_json(400, '请求数据结构无法被解析'));
                return false;
            }

//            $validate = new MessageFormatValidate();
//            if (false === $validate->check($originMessage)) {
//                Gateway::closeClient($clientId, broadcast_json(400, $validate->getError()));
//                return false;
//            }
            $groupId = $originMessage['group_id'] ?? 0;
            switch ($originMessage['event']) {
                case 'join':
                    /** 群聊 */
                    if ($originMessage['mode'] === 2) {
                        $_SESSION['group_id'] = $groupId;
                        Gateway::joinGroup($clientId, $groupId);
                        /** 私聊 */
                    } else {
                        Gateway::bindUid($clientId, $originMessage['from_user_id']);
                    }
                    $_SESSION['mode'] = $originMessage['mode'];
                    $_SESSION['event'] = $originMessage['event'];
                    $_SESSION['group_id'] = $groupId;
                    $_SESSION['from_user_id'] = $originMessage['from_user_id'];
                    $_SESSION['from_username'] = $originMessage['from_username'];
                    $originMessage['event'] = 'init';
                    Gateway::sendToCurrentClient(broadcast_json(0, 'success', $originMessage));
                    break;
                case 'speak':
                    MessageModel::create([
                        'from_user_id' => $originMessage['from_user_id'],
                        'from_username' => $originMessage['from_username'],
                        'from_avatar' => $originMessage['from_avatar'] ?? '',
                        'to_user_id' => $originMessage['to_user_id'],
                        'group_id' => $groupId,
                        'type' => 1,
                        'mode' => $originMessage['mode'],
                        'content' => $originMessage['content']
                    ]);
                    /** 私聊 */
                    if ($originMessage['mode'] == 1) {
                        $msg = $originMessage['from_username'] . '[单聊对]' . $originMessage['to_user_id'] . '[说]：' . $originMessage['content'];
                        Gateway::sendToUid($originMessage['to_user_id'], broadcast_json(0, $msg, $originMessage));
                        /** 群聊 */
                    } else {
                        $msg = $originMessage['from_username'] . '[群聊说]：' . $originMessage['content'];
                        Gateway::sendToGroup($groupId, broadcast_json(0, $msg, $originMessage));
                    }
                    break;
                case 'ping':
                    Gateway::sendToClient($clientId, broadcast_json(0, '心跳检测'));
                    break;
                default:
                    Gateway::sendToCurrentClient(broadcast_json(400, 'default invalid', $originMessage));
            }
        } catch (\Throwable $throwable) {
            return Gateway::sendToClient($clientId, broadcast_json(500, $throwable->getMessage()));
        }
        return true;
    }

    /**
     * @desc: 客户端与Gateway进程的连接断开时触发
     * @param $clientId
     * @return bool
     * @author Tinywan(ShaoBo Wan)
     */
    public static function onClose($clientId): bool
    {
        try {
            $data = [
                'event' => 'leave',
                'group_id' => $_SESSION['group_id'] ?? '',
                'client_id' => $clientId,
                'content' => 'leaving group',
                'from_user_id' => $_SESSION['from_user_id'] ?? '',
                'from_username' => $_SESSION['from_username'] ?? ''
            ];
            if (isset($data['group_id']) && !empty($data['group_id'])) {
                GateWay::sendToGroup($data['group_id'], broadcast_json(0, 'close', $data));
                return true;
            }
            return Gateway::sendToCurrentClient(broadcast_json(500, 'error', $data));
        } catch (\Throwable $e) {
            $data = ['client_id' => $clientId, 'content' => $e->getMessage()];
            Log::error('[onClose] ' . $e->getMessage() . '|' . $e->getFile() . '|' .
                $e->getLine() . ': clientId = ' . $clientId);
            return Gateway::sendToCurrentClient(broadcast_json(500, 'error', $data));
        }
    }

}
