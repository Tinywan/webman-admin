<?php
/**
 * @desc MethodNotAllowedException
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/3/6 15:47
 */

declare(strict_types=1);

namespace support\exception;

use Tinywan\ExceptionHandler\Exception\BaseException;

class MethodNotAllowedException extends BaseException
{
    /**
     * @var int
     */
    public int $statusCode = 405;

    /**
     * @var string
     */
    public string $errorMessage = '请求行中指定的请求方法不能被用于请求相应的资源';
}