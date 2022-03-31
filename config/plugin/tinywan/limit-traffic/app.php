<?php

return [
    'enable' => true,
    'limit' => [
        'limit' => 10, // 请求次数
        'window_time' => 60, // 窗口时间，单位：秒
        'body' => 'Too Many Requests' // 响应信息
    ]
];
