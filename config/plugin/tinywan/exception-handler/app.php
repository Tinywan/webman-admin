<?php

return [
    'enable' => true,
    // 错误异常配置
    'exception_handler' => [
        // 不需要记录错误日志
        'dont_report' => [
            Tinywan\ExceptionHandler\Exception\BadRequestHttpException::class,
            Tinywan\ExceptionHandler\Exception\UnauthorizedHttpException::class,
            Tinywan\ExceptionHandler\Exception\ForbiddenHttpException::class,
            Tinywan\ExceptionHandler\Exception\NotFoundHttpException::class,
            Tinywan\ExceptionHandler\Exception\RouteNotFoundException::class,
            Tinywan\ExceptionHandler\Exception\TooManyRequestsHttpException::class,
            Tinywan\ExceptionHandler\Exception\ServerErrorHttpException::class,
            Tinywan\Validate\Exception\ValidateException::class,
            Tinywan\Jwt\Exception\JwtTokenException::class
        ]
    ],
    // 事件
    'event' => [
        'enable' => false,
        // 钉钉机器人
        'ding_talk' => [
            'accessToken' => 'xxxxxxxxxxxxxxxx',
            'secret' => 'xxxxxxxxxxxxxxxx',
            'title' => '钉钉机器人异常通知',
        ]
    ],
];
