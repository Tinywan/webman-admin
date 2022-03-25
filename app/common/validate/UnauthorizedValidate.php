<?php
/**
 * @desc UnauthorizedValidate.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/1/5 13:27
 */

declare(strict_types=1);

namespace app\common\validate;

class UnauthorizedValidate extends BaseValidate
{
    /**
     * 验证规则定义.
     *
     * @var array
     */
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'code' => 'require',
    ];

    /**
     * 验证消息定义
     *
     * @var array
     */
    protected $message = [
        'username.require' => 'username不允许为空',
        'password.require' => 'password不允许为空',
        'code.require' => 'code不允许为空',
    ];

    /**
     * 验证场景定义
     *
     * @var array
     */
    protected $scene = [
        'issue' => ['username', 'password','code'],
    ];
}