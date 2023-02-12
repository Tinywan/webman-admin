<?php
return [
    // 自定义Text协议
    'text.protocol' => [
        'handler'=> \Tinywan\Rpc\Protocol\RpcTextProtocol::class,
        'listen' => config('plugin.tinywan.rpc.app.server.listen_text_address'),
        'count'  => 10, // 根据配置文件调整
    ]
];