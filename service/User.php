<?php
/**
 * @desc User.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/3/31 14:14
 */
declare(strict_types=1);


namespace service;


class User
{
    public function get($uid)
    {
        return json_encode([
            'uid'  => $uid,
            'name' => 'webman'
        ]);
    }
}