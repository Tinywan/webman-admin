<?php
/**
 * @desc 身份认证
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/19 16:55
 */

declare(strict_types=1);

namespace app\controller;

use app\common\validate\UserValidate;
use support\Log;
use support\Request;
use Tinywan\Jwt\JwtToken;
use Webman\Config;
use Yansongda\Pay\Pay;

class Test
{
    public function validate(Request $request)
    {
        $data = [
            'name'  => 'Tinywan',
            'age'  => 24,
            'email' => 'Tinywan@163.com'
        ];
        validate($data, UserValidate::class . '.issue');
        var_dump(JwtToken::getUser()['id']);
        return 'suss';
    }

    public function payment(Request $request)
    {
        // 1. 获取配置文件 config/payment.php
        $config = Config::get('payment');

        // 2. 初始化配置
        Pay::config($config);

        // 3. 网页支付
        $order = [
            'out_trade_no' => time(),
            'total_amount' => '88.88',
            'subject' => '沙箱支付测试',
            '_method' => 'get' // 使用get方式跳转
        ];
        Log::info('『支付宝』： '.json_encode($order));
        return Pay::alipay()->web($order)->getBody()->getContents();
    }
}
