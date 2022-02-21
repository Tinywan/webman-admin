<?php
/**
 * @desc RouteNotFoundException
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/2/21 22:35
 */

declare(strict_types=1);

namespace support\exception;

class RouteNotFoundException extends BaseException
{
    /**
     * HTTP 状态码
     */
    public int $statusCode = 404;

    /**
     * 错误消息.
     */
    public string $errorMessage = '路由地址不存在';
}