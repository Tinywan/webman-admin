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
            'app_secret_cert' => 'MIIEpAIBAAKCAQEArGZw7D1VrBzkgjDxMYZEb7tQ2D2brYvz7dXrJZQJ9oDdh+HKc6lXyOVzurbsnFhjFJ7BtHPCx2L7OAfIrrQxgJhLcDrsGCDKLbl19PN68Ca633zeRLYsIJOjqjVPjOMNF43df1vN3aArI4+v7O75dvtf56ia+TIwqnwl51qWeky3R77g2Cnj2fp7sy349DPB36/jdD7Hbj486yZgA0ZepGgAjgwJZWiEcCudpCTaXG3Liq29YDEGsWsw7km783lcsh9FfrkDgisUgDGYyV+SqydjdRX+IlAH27vMrybAuPQd9aR08Jh34TpbmodpX4cS8g3282bi5YzuVxxPdNetjwIDAQABAoIBAQCeszqWLav04S/1LOqKxWewVwWH2ca6TlABC2AIWquFMIE9ebttF2FI/Pe41HUhQzgKHk6AN+QAuXw6yueQ8y1yjD89k/AMEfsrdkNAdvYfpfd2jbLqG6ypXF9X6vVM4yIFIcHZYIA02SF8/eNbv20De0mArjPi27Hy7o/R1hEZiIySo2xZTDxnSz6C+iPM085YhE9KlUhSGeOaxxhx/Z8sef2v2fkrEdRv7oojJgpvtiOZh+Xnsq3evAu2RfwKvR8bELvg8deOlGjrYXu9mD2ZNQnCBv+l4XX1A36w+eTaz4Y9fI72C/nDba5WJ8Oq6KjHm3NvOnQkpj5TurLEhbwhAoGBANLn8mcUqLjFxVOTNbFVkJeiAG0zHJYFqWn7zEPS86ypBm170+V2ZfcAPTj42hovFzmxU+4iF1UMkE45lQOke1EzDpTJ9EYsoe5Q491mfBprF4QOavRjA79IubbGrAiyLxZQ800L9eK5+1XsHObInM8i1BRjIOXWAcGJzlUNAaX/AoGBANFC2sJMGwbVdS+rMFGsJDtChjrJs19wdMmdFzqdEpOogKx1yJpAjACkbBLs9B6FifxUfOaNo/ECRhfYOGDokIPUcWxKiltV1ToYf3bO8mA/Z+OurxIYM3KT4EnE2Wx6bRXP3pRbJjSGcNHJBZCNOvM/Vwhh0S/4+tgpyyovcphxAoGBALZ2CFZ5nwZLw01snBURS4iDlQ7kGyUHPOv99VfwFvQXPwJVEJsB9XDdehnh4P6qItO8wDnSsJDZz7Z9RpfiIvW60DCVD4nubyF4RcpzMYbBg5SxzIIlb0Z7qn+gHZFgZjBOVE8hu9YsxG4vWUmn4VGqdgQ1Rm7Q2LARgro+CGENAoGAP4qJWo45dq3CU6MrnOEkb0oX8Cnm6YgALmgg8Y9YYLW9vKBXNV98I4XJu0VwKwRpjdEpy+gea8RA/GSPWf3ERANyHWvU7z707BscOTtFpawbI6ubRWdL1/LHHB9F1gamsQTZlTrIMxLPlyPvKKF50PretpDdMC/uG001f63AokECgYBs+OmwGsvsa7qfIfB6hWSOS+VPw1F4wf/WIS5yR3bTkHZ3we/FLcvBQ1dmNJeceqfKq0dF+FMXTIUVKxCGOidB37r/itAuOZUD2V2ItpE2Q4TxKxKGWeV2Vj/z2WoO2hrJrapJ0+7OwYvmFY5AqxUJv/8iSP4r3m4OUmD/+XDgCg==',
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
    ],
    'wechat' => [
        'default' => [
            // 必填-商户号，服务商模式下为服务商商户号
            'mch_id' => '',
            // 必填-商户秘钥
            'mch_secret_key' => '',
            // 必填-商户私钥 字符串或路径
            'mch_secret_cert' => '',
            // 必填-商户公钥证书路径
            'mch_public_cert_path' => '',
            // 必填
            'notify_url' => 'https://yansongda.cn/wechat/notify',
            // 选填-公众号 的 app_id
            'mp_app_id' => '2016082000291234',
            // 选填-小程序 的 app_id
            'mini_app_id' => '',
            // 选填-app 的 app_id
            'app_id' => '',
            // 选填-合单 app_id
            'combine_app_id' => '',
            // 选填-合单商户号
            'combine_mch_id' => '',
            // 选填-服务商模式下，子公众号 的 app_id
            'sub_mp_app_id' => '',
            // 选填-服务商模式下，子 app 的 app_id
            'sub_app_id' => '',
            // 选填-服务商模式下，子小程序 的 app_id
            'sub_mini_app_id' => '',
            // 选填-服务商模式下，子商户id
            'sub_mch_id' => '',
            // 选填-微信公钥证书路径, optional，强烈建议 php-fpm 模式下配置此参数
            'wechat_public_cert_path' => [
                '45F59D4DABF31918AFCEC556D5D2C6E376675D57' => __DIR__.'/Cert/wechatPublicKey.crt',
            ],
            // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SERVICE
            'mode' => \Yansongda\Pay\Pay::MODE_SANDBOX,
        ]
    ],
    'logger' => [
        'enable' => false,
        'file' => runtime_path().'/logs/alipay.log',
        'level' => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
        'type' => 'single', // optional, 可选 daily.
        'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
    ],
    'http' => [ // optional
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
    ]
];