<?php
declare(strict_types=1);

return [
    'instance-registrar' => [
        'handler'  => \Workbunny\WebmanNacos\Process\InstanceRegistrarProcess::class
    ],
    'config-listener' => [
        # 多Timber异步监听器，多个监听异步非阻塞执行
        'handler'  => \Workbunny\WebmanNacos\Process\AsyncConfigListenerProcess::class
//        # 单Timer同步监听器，多个监听并发且阻塞执行
//        'handler'  => \Workbunny\WebmanNacos\Process\ConfigListenerProcess::class
    ]
];
