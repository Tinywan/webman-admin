<?php
/**
 * @desc 支付配置文件
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/03/11 20:15
 */
 
return [
    'alipay' => [
        'default' => [
            // 必填-支付宝分配的 app_id
            'app_id' => '2016090900470841',
            // 必填-应用私钥 字符串或路径
            'app_secret_cert' => 'MIIEpAIBAAKCAQE4OUmD/+XDgCg==',
            // 必填-应用公钥证书 路径
            'app_public_cert_path' => public_path().'/appCertPublicKey_2016090900470841.crt',
            // 必填-支付宝公钥证书 路径
            'alipay_public_cert_path' => public_path().'/alipayCertPublicKey_RSA2.crt',
            // 必填-支付宝根证书 路径
            'alipay_root_cert_path' => public_path().'/alipayRootCert.crt',
            'return_url' => 'http://micro.train.tinywan.cn/gateway/payment/alipay-return',
            'notify_url' => 'http://micro.train.tinywan.cn/gateway/payment/alipay-notify',
            // 选填-服务商模式下的服务商 id，当 mode 为 Pay::MODE_SERVICE 时使用该参数
            'service_provider_id' => '',
            // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SANDBOX, MODE_SERVICE
            'mode' => \Yansongda\Pay\Pay::MODE_SANDBOX,
        ]
    ]
];