<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace support\exception;

use Tinywan\ExceptionHandler\Exception\BaseException;

/**
 * Class BusinessException
 * @package support\exception
 */
class BusinessException extends BaseException
{
    /**
     * @var int
     */
    public int $statusCode = 403;

    /**
     * @link 解决跨域问题
     * @var array
     */
    public array $header = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Allow-Headers' => 'Authorization,Content-Type,If-Match,If-Modified-Since,If-None-Match,If-Unmodified-Since,X-Requested-With,Origin',
        'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
    ];

    /**
     * @var string
     */
    public string $errorMessage = '对不起，您没有该接口访问权限，请联系管理员';
}