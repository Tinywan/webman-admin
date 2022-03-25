<?php

return [
    'enable' => true,
    'jwt' => [
        // 算法类型 HS256、HS384、HS512、RS256、RS384、RS512、ES256、ES384、Ed25519
        'algorithms' => 'HS256',
        // access令牌秘钥
        'access_secret_key' => '2022d3d3LmJq',
        // access令牌过期时间，单位秒。默认 2 小时
        'access_exp' => 120,
        // refresh令牌秘钥
        'refresh_secret_key' => '2022KTxigxc9o50c',
        // refresh令牌过期时间，单位秒。默认 7 天
        'refresh_exp' => 72000,
        // 令牌签发者
        'iss' => 'webman.tinywan.cn',
        // 令牌签发时间
        'iat' => time(),
        // 时钟偏差冗余时间，单位秒。建议这个余地应该不大于几分钟。
        'leeway' => 60,
        // 单设备登录
        'is_single_device' => false,
        // 缓存令牌时间，单位：秒
        'cache_token_ttl' => 72000,
        // 缓存令牌前缀
        'cache_token_pre' => 'JWT:TOKEN:',

        /**
         * access令牌私钥
         */
        'access_private_key' => <<<EOD
-----BEGIN RSA PRIVATE KEY-----
...
-----END RSA PRIVATE KEY-----
EOD,

        /**
         * access令牌公钥
         */
        'access_public_key' => <<<EOD
-----BEGIN PUBLIC KEY-----
...
-----END PUBLIC KEY-----
EOD,

        /**
         * refresh令牌私钥
         */
        'refresh_private_key' => <<<EOD
-----BEGIN RSA PRIVATE KEY-----
...
-----END RSA PRIVATE KEY-----
EOD,

        /**
         * refresh令牌公钥
         */
        'refresh_public_key' => <<<EOD
-----BEGIN PUBLIC KEY-----
...
-----END PUBLIC KEY-----
EOD,
    ],
];
