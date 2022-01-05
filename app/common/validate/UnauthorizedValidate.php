<?php
/**
 * @desc UnauthorizedValidate.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/1/5 13:27
 */

namespace app\common\validate;

use webman\Validate;

class UnauthorizedValidate extends Validate
{
    /**
     * 验证规则定义.
     *
     * @var array
     */
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
    ];

    /**
     * 验证消息定义
     *
     * @var array
     */
    protected $message = [
        'username.require' => 'username不允许为空',
        'password.require' => 'password不允许为空',
    ];

    /**
     * 验证场景定义
     *
     * @var array
     */
    protected $scene = [
        'issue' => ['username', 'password'],
    ];
}