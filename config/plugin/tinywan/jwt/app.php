<?php
return [
    'enable' => true,
    'jwt' => [
        // 算法类型 ES256、HS256、HS384、HS512、RS256、RS384、RS512
        'algorithms' => 'RS256',
        // access令牌秘钥
        'access_secret_key' => '2022d3d3LmJq',
        // access令牌过期时间，单位秒。默认 2 小时
        'access_exp' => 36000,
        // refresh令牌秘钥
        'refresh_secret_key' => '2022KTxigxc9o50c',
        // refresh令牌过期时间，单位秒。默认 7 天
        'refresh_exp' => 72000,
        // 令牌签发者
        'iss' => 'webman.tinywan.cn',
        // 令牌签发时间
        'iat' => time(),

        /**
         * access令牌 RS256 私钥
         * 生成RSA私钥(Linux系统)：openssl genrsa -out access_private_key.key 1024 (2048)
         */
        'access_private_key' => <<<EOD
-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----
EOD,
        /**
         * access令牌 RS256 公钥
         * 生成RSA公钥(Linux系统)：openssl rsa -in access_private_key.key -pubout -out access_public_key.key
         */
        'access_public_key' => <<<EOD
-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAnlCPokjMyESsPeJZD0yE
qPuiGf686pH24kcgGGG1QX+xK21UR5OEeUMO+8Ito6DuMwoWMlt4X9nnzGM08hbB
spT7s++yC+B2YoiGFYUIjnVfHKVMWYpM4TAGMcjHo8uKTraJTaIQBJQH3sh0ck4/
Z+RIu1YMqqcLQNn+PRl045swjYSeHwrr1uUYNuDRmxPbROQ19jVyWzdikiEZMU1g
xM2Vsl8KXQguFZlTeZlR7eUbdM7GZurGoiqwAr6SmQfz+JrNLSJ+QAL8LZsxPxkK
WyJjkYiW0p1FsBX7Ddn61Ht+mGzp4O37kicQ8b85NyDB9vYWNf94gqXyhC8f0nVJ
acMnqv1rYy2s+q6AEU9J/BuR6v97w5uT5BdZvCmCTEL42063vzhpPUTwqZhDywVw
yynghEDZ1gueJZ7HVGY4Vn8oxefZaT8HNjOUmi0zfSsW4XzAV2EcKuhzN4A5IBUG
tEYSozd2lSD1jjRYTqr0F/4HGA9pre6VakkBc3JtJr2p74ST3+VBqWWDx8EqoSa3
dqFP2G0b4VucAcQiLd0HGJ6G9jx8OmOgpfflAawmZIN17dcnxxN/tZpUE3qwXFY/
utBhW1Shy2MglCfRPasxaCqsSTCKKbfjwSSqUOhLVWIdaGFedtOxie3Ae775jMgn
oW/2aXce+MIiHBi8N+tjdmMCAwEAAQ==
-----END PUBLIC KEY-----
EOD,

        /**
         * refresh令牌 RS256 私钥
         * 生成RSA私钥(Linux系统)：openssl genrsa -out refresh_private_key.key 1024 (2048)
         */
        'refresh_private_key' => <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIIJKQIBAAKCAgEAnlCPokjMyESsPeJZD0yEqPuiGf686pH24kcgGGG1QX+xK21U
R5OEeUMO+8Ito6DuMwoWMlt4X9nnzGM08hbBspT7s++yC+B2YoiGFYUIjnVfHKVM
WYpM4TAGMcjHo8uKTraJTaIQBJQH3sh0ck4/Z+RIu1YMqqcLQNn+PRl045swjYSe
Hwrr1uUYNuDRmxPbROQ19jVyWzdikiEZMU1gxM2Vsl8KXQguFZlTeZlR7eUbdM7G
ZurGoiqwAr6SmQfz+JrNLSJ+QAL8LZsxPxkKWyJjkYiW0p1FsBX7Ddn61Ht+mGzp
4O37kicQ8b85NyDB9vYWNf94gqXyhC8f0nVJacMnqv1rYy2s+q6AEU9J/BuR6v97
w5uT5BdZvCmCTEL42063vzhpPUTwqZhDywVwyynghEDZ1gueJZ7HVGY4Vn8oxefZ
aT8HNjOUmi0zfSsW4XzAV2EcKuhzN4A5IBUGtEYSozd2lSD1jjRYTqr0F/4HGA9p
re6VakkBc3JtJr2p74ST3+VBqWWDx8EqoSa3dqFP2G0b4VucAcQiLd0HGJ6G9jx8
OmOgpfflAawmZIN17dcnxxN/tZpUE3qwXFY/utBhW1Shy2MglCfRPasxaCqsSTCK
KbfjwSSqUOhLVWIdaGFedtOxie3Ae775jMgnoW/2aXce+MIiHBi8N+tjdmMCAwEA
AQKCAgEAlIWJqrrXe06JtGjkGmkzz4B6vB5yxzF2xyPo5VbNAAy2fsJLnfa0Ajs6
FFBAFtFEhpeA6W9Mx8ebIfE0W6WjxFDmrhFCHMhQ5/GisQ+kTlmoiCw/K4WGyIAQ
X6Y4PN8X+u5ec3mFw3XIyGWQcSgdbe8JmM6KhZK/CPE6BcIbGeierTVsTj0lse4t
QFa77du8Cq56PWg4x4B3NhZdFxa7oQYp2TQ2eb7R1SuJ13tSFHeqwXO3SBgbj0my
5HA7AdwnMuSvdhd1D8J9KJ/+nG52e7cQaBkXPbGUDjUg2QbVvX+57W/IHl/FcoC5
8cHvAFv3/CM0BSaNvSvID+BR31RvMJLMhJidIgyjJCkAwRsopclXM+aED6g39Zuv
BuneNFhuj9Em+T+9gZdoHxGpUvQfG/F13ieUilLrOlxZUsZbRPhw/fxUOsZGS7un
9gvNo8g8uFN1rVVbU66FKjRuaW+67IvXgJJWvcBa1BmDjNQERtILv8wh+kn9nieN
JiR629Zkq9cl/Tz2HqEs+DIISpDWQcNvlQ5Sj3ijlMRUaNcu0COcckzr6iktDaIK
SBllzYneZIlgRdCo9fqG6ZROH6Rm0X1YoK1Oif432ZEjMM/RWmqbvaK1Bi5BBymZ
+6b1bwswa9cyXEXv7QEeYPpE66oEKfUAKpc8png52gKw0cFnHMkCggEBAMmIdbZ5
1+j3jH0Ma9f0mHPiS9a0qqmvmi7kkg8eCqfCrVKYEZHvVbH3g5Z1Nnf+8Wt4S9P4
jqjSwlENs1dE7rmHkzlw7DUe4wSI3fNT5Kf9HTK04VZByeRNyaSGwkpPjH/5ajbA
PeY5pInuUsnPVxSKs5mObKqF9T2gw/eqLierspdkHqFIoHjp2ukze4oChPR9m5Te
o7lU2gzCusW1/QGuMGyKJqMwGknMccA8NtTbT4VK2lNBWy6bocfDlHp6XoR/kyWr
+LHwaM8Hx5d9mtOaFxJdBurKq6B4S95tzVps+xJC00/Xox+YMMDB+NXSU89tFxLl
P7EEjmjDotcX3yUCggEBAMkZ7+713Py2ZKMCl3jd6R64LE2n/2YrmQzKxu1W3nGh
/qtOYaeY5e8X4iBVfduzwzLn0OiMg3msCJ99cyzYqyWZpKVhV875NXvij6dxof1E
aNkraiNZjWPTYi9JIdqi2gzOormsVbnVlrbHE152uMy6iX5H2iizZFFk4kD+Yu94
VKtCJhdLUyZ0QRBXMaHiEoyXpK9WC4sKMjSFo4isGeZNHu10Bww4Es1A8AFxF7YX
N5BA4hrBk0utPCCOydJTXJIOrwwRLXimMzqWmNghf9YQm735ZttGUkzmcC0hyaoy
0JUyESD2EuMDFMHo5D+/FV60/BIxw1bfpVOww5qn7OcCggEBAIqO2W+Fwd4YJGzt
F1A4iIBT+5Q4ToWvh6/p0km2e9jvTb7Vcm8FP8PFyqCtIa/Khi0/XdL0txB3JsYX
R1AewoqoHZ6Gdr/m5mn9t6tN6I1exq5QEgT94lKm8JW/WOFCY/SwhEf0UBpzUx7J
zf2WIearneNbOnba9stSNqmWRXlc4MKZQT3d8wZuseVXUf6G0OZPXaIymBoZrnjL
gSHhh3uaSQy2xu23aruGZkamn4Qk7D1WQ1iuPISE1+vCGdlDPKyYEZD69VdRVJ3S
WXVcFBCbhnVHpDPU976yNmdM0rzy5IOfkiz4stxMBGjic7R+kMSx2gVRvEJ2QXrh
1plPfkkCggEAL8ht7kWVIKbl+qWfACUaQyZXwIvub4RkdVmpMrO1XyKytFmHcp8t
40W1gSFPKmjoNKxIQzk/9CUgV2UjfMBuyhxbtsAOcStdvfXzVEH3z4n1r8RVD9kz
c0jCx6GE3cJcNTbUC3IbXHCXww5CV+u1tU+NY+gGui0F5SEncXIAaA4bcCXjjx1i
wHxXCV7ueByTc7yEcPTtATiG/VvTo6Hg9YvVkW5ETm70aLjJTk5k5+tUVH5WOy1L
pmufIc1LvyH3mOzMQv3B5Cz5dy5ZWuF60o5XsygTfH6VB5iphs/EbyBr10dyMnbF
vhL5V6nSsiLhHQO78UbJt1akneIeWB0WeQKCAQA5RCxTra8m/Tty6EzqkolCTkE1
Zk8rwHGtHA40lToCEE638aAN1zAbsCfQkdV24GKibc0H21qtFnvMm5IcvUSBpK58
vpwiYJJIY7yH9g928pG4Yy3q8squF8uOrF4fy8+JtaRzVzgIKteZwMjVJFIsMOFE
9njEo/7V9JvZSLmp2B9F8/U5/9EOsZSzA6RAtkfx8aBJx/3YatfZJt8OG9yUnS1E
JEQ4SJRaaTcfrvW6e5aKpXCZbat6vzbhZz5odf+ZN4Rov5ucOurvOv2UvQ5nZKBu
CkHkdG35sc9Wl7hBElOMn6vCcsknMILauqS9aKSUP1QvMjKY0NVhyuV6P1Db
-----END RSA PRIVATE KEY-----
EOD,
        /**
         * refresh令牌 RS256 公钥
         * 生成RSA公钥(Linux系统)：openssl rsa -in refresh_private_key.key -pubout -out refresh_public_key.key
         */
        'refresh_public_key' => <<<EOD
-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAnlCPokjMyESsPeJZD0yE
qPuiGf686pH24kcgGGG1QX+xK21UR5OEeUMO+8Ito6DuMwoWMlt4X9nnzGM08hbB
spT7s++yC+B2YoiGFYUIjnVfHKVMWYpM4TAGMcjHo8uKTraJTaIQBJQH3sh0ck4/
Z+RIu1YMqqcLQNn+PRl045swjYSeHwrr1uUYNuDRmxPbROQ19jVyWzdikiEZMU1g
xM2Vsl8KXQguFZlTeZlR7eUbdM7GZurGoiqwAr6SmQfz+JrNLSJ+QAL8LZsxPxkK
WyJjkYiW0p1FsBX7Ddn61Ht+mGzp4O37kicQ8b85NyDB9vYWNf94gqXyhC8f0nVJ
acMnqv1rYy2s+q6AEU9J/BuR6v97w5uT5BdZvCmCTEL42063vzhpPUTwqZhDywVw
yynghEDZ1gueJZ7HVGY4Vn8oxefZaT8HNjOUmi0zfSsW4XzAV2EcKuhzN4A5IBUG
tEYSozd2lSD1jjRYTqr0F/4HGA9pre6VakkBc3JtJr2p74ST3+VBqWWDx8EqoSa3
dqFP2G0b4VucAcQiLd0HGJ6G9jx8OmOgpfflAawmZIN17dcnxxN/tZpUE3qwXFY/
utBhW1Shy2MglCfRPasxaCqsSTCKKbfjwSSqUOhLVWIdaGFedtOxie3Ae775jMgn
oW/2aXce+MIiHBi8N+tjdmMCAwEAAQ==
-----END PUBLIC KEY-----
EOD,
    ],
];