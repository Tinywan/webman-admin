<?php
/**
 * @desc UserValidate
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/2/19 23:28
 */

declare(strict_types=1);

namespace app\common\validate;


class UserValidate extends BaseValidate
{
    protected $rule =   [
        'name'  => 'require|max:25',
        'age'   => 'require|number|between:1,120',
        'email' => 'require|email'
    ];

    protected $message  =   [
        'name.require' => '名称必须填写',
        'name.max'     => '名称最多不能超过25个字符',
        'age.require'   => '年龄必须填写',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email.require' => '邮箱必须填写',
        'email.email'   => '邮箱格式错误'
    ];
}