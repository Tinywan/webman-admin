<?php
/**
 * @desc BaseException.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/1/5 13:44
 */

declare (strict_types = 1);

namespace support\exception;

class BaseException extends \Exception
{
    /**
     * HTTP status code.
     */
    public int $statusCode = 400;

    /**
     * Response Error message.
     */
    public string $errorMessage = 'The requested resource is not available or not exists';

    /**
     * Response Header.
     */
    public array $header = [];

    /**
     * Response Error code.
     *
     * @var int|mixed
     */
    public int $errorCode = 0;

    /**
     * Response data.
     */
    public array $data = [];

    /**
     * BaseException constructor.
     * @param string $errorMessage
     * @param array $params
     */
    public function __construct(string $errorMessage = '', array $params = [])
    {
        parent::__construct();
        if (!empty($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
        if (!empty($params)) {
            if (array_key_exists('statusCode', $params)) {
                $this->statusCode = $params['statusCode'];
            }
            if (array_key_exists('header', $params)) {
                $this->header = $params['header'];
            }
            if (array_key_exists('errorCode', $params)) {
                $this->errorCode = $params['errorCode'];
            }
            if (array_key_exists('data', $params)) {
                $this->data = $params['data'];
            }
        }
    }
}
