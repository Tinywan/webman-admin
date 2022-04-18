<?php
return [
    'enable' => true,
    'event' => [
        // 事件监听
        'listener'    => [
            \app\listener\LoggerListener::NAME => \app\listener\LoggerListener::class
        ],

        // 事件订阅器
        'subscriber' => [
            \app\subscribe\ExceptionSubscribe::class
        ],
    ]
];