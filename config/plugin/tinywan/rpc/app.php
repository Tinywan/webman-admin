<?php

return [
    'enable' => true,
    'server' => [
        'namespace'=> 'app\\rpc\\', // 自定义服务命名空间
        'listen_text_address' => 'text://0.0.0.0:8889', // 自定义Text协议地址
    ],
];
