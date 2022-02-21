<?php
/**
 * @desc BadRequestHttpException
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/2/21 22:36
 */

declare(strict_types=1);

namespace support\exception;

class BadRequestHttpException extends BaseException
{
    /**
     * HTTP 状态码
     */
    public int $statusCode = 400;

    /**
     * 错误消息.
     */
    public string $errorMessage = '请求参数错误，服务器不能或不会处理该请求';
}