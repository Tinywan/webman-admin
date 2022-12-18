<?php
/**
 * @desc 支付网关
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/11/10 10:58
 */

declare (strict_types = 1);

namespace app\gateway\controller;

use support\Log;
use support\Request;
use support\Response;
use Webman\Config;
use Yansongda\Pay\Exception\ContainerException;
use Yansongda\Pay\Exception\InvalidParamsException;
use Yansongda\Pay\Pay;


class PaymentGateway
{
    /**
     * @desc:『支付宝』异步通知
     * @param Request $request
     * @return Response
     * @throws ContainerException|InvalidParamsException
     */
    public function alipayNotify(Request $request): Response
    {
        Log::info('『支付宝』异步通知 '.json_encode($request->post()));
        $config = Config::get('payment');
        Pay::config($config);
        $result = Pay::alipay()->callback($request->post());
        Log::info('『支付宝』接收支付宝回调： '.json_encode($result));
        Log::info('『支付宝』确认回调： '.json_encode(Pay::alipay()->success()->getBody()->getContents()));
        return new Response(200, [], 'success');
    }

    /**
     * @desc: 『支付宝』同步通知
     * @param Request $request
     * @return Response
     * @author Tinywan(ShaoBo Wan)
     */
    public function alipayReturn(Request $request): Response
    {
        $param = $request->get();
        return new Response(200, [], 'success');
    }
}
