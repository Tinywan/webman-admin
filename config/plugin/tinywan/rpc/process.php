<?php
/**
 * @desc ${NAME}
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/3/20 0:34
 */

return [
    // 自定义Text协议
    'text.protocol' => [
        'handler'=> \Tinywan\Rpc\Protocol\RpcTextProtocol::class,
        'listen' => config('plugin.tinywan.rpc.app.rpc.listen_text_address'),
        'count'  => 10, // 根据配置文件调整
    ]
];
