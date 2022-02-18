<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace support\exception;

use extend\event\LogErrorWriteEvent;
use Tinywan\Validate\Exception\ValidateException;
use webman\event\EventManager;
use Webman\Http\Request;
use Webman\Http\Response;
use Throwable;
use Webman\Exception\ExceptionHandler;

/**
 * Class Handler
 * @package support\exception
 */
class Handler extends ExceptionHandler
{
    public $dontReport = [
        BusinessException::class,
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render(Request $request, Throwable $e) : Response
    {
        $responseData = [
            'request_url' => $request->method() . ' ' . $request->fullUrl(),
            'timestamp' => date('Y-m-d H:i:s'),
            'client_ip' => $request->getRealIp(),
            'request_param' => $request->all(),
        ];
        $errorCode = 0;
        $errorSql = '';
        $header = [];
        if ($e instanceof BaseException) {
            $statusCode = $e->statusCode;
            $header = $e->header;
            $errorMessage = $e->errorMessage;
            $errorCode = $e->errorCode;
            if ($e->data) {
                $responseData = array_merge($responseData, $e->data);
            }
        } else {
            $errorMessage = $e->getMessage();
            if ($e instanceof ValidateException) {
                $statusCode = 400;
            } elseif ($e instanceof \InvalidArgumentException) { // 当参数不是预期的类型时
                $statusCode = 415;
                $errorMessage = '预期参数配置异常：' . $e->getMessage();
            } else {
                $statusCode = 500;
                $errorMessage = $e->getMessage();
                $errorCode = 500000;
            }
            // 触发日志
            if ($statusCode == 500) {
                EventManager::trigger(new LogErrorWriteEvent([
                    'request_url' => $responseData['request_url'],
                    'client_ip' => $responseData['client_ip'],
                    'request_param' => $responseData['request_param'],
                    'message' => $errorMessage,
                    'code' => $errorCode,
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'error_sql' => $errorSql,
                    'trace' => (string) $e->getTraceAsString(),
                ]), LogErrorWriteEvent::NAME);
            }
        }
        if (config('app.debug')) {
            $responseData['error_message'] = $errorMessage;
            $responseData['error_trace'] = (string) $e->getTraceAsString();
        }

        return response_json($errorCode, $errorMessage, $responseData, $statusCode, $header);
    }

}