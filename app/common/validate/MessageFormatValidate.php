<?php
/**
 * @desc IM消息格式验证器类，用于验证IM消息格式是否正确，以及消息内容是否合法，比如：消息类型、消息长度等等
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2023/12/10 10:50
 */

declare(strict_types=1);

namespace app\common\validate;


class MessageFormatValidate extends BaseValidate
{
    /**
     * @var string[]
     */
    protected $rule = [
        'mode' => 'require|in:1,2',
        'group_id' => 'require|number',
        'from_user_id' => 'require',
        'from_username' => 'require',
        'content' => 'require|max:128',
    ];

    /**
     * @var string[]
     */
    protected $message = [
        'mode.require' => '消息模式是必须的',
        'mode.in' => '消息模式只能是1或2',
        'group_id.require' => '群组group_id是必须的',
        'from_user_id.require' => '用户id是必须的',
        'from_username.require' => '用户名必须填写',
        'content.require' => '消息内容是必须的',
        'content.max' => '消息内容最大支持128个字符',
    ];
}