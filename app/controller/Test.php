<?php
/**
 * @desc 身份认证
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/19 16:55
 */

declare(strict_types=1);

namespace app\controller;

use app\common\validate\UnauthorizedValidate;
use app\common\validate\UserValidate;
use support\Request;
use Tinywan\Jwt\JwtToken;

class Test
{
    public function validate(Request $request)
    {
        $data = [
            'name'  => 'Tinywan',
            'age'  => 24,
//            'email' => 'Tinywan@163.com'
        ];
        validate($data, UserValidate::class . '.issue');
//        $validate = new UserValidate();
//        if (false === $validate->check($data)) {
//            return 'fail, '.$validate->getError();
//        }
        return 'success';
    }

    public function jwt(Request $request)
    {
        $user = [
            'uid'  => 2022,
            'name'  => 'Tinywan',
            'email' => 'Tinywan@163.com'
        ];
        $token = JwtToken::generateToken($user);
//        var_dump(json_encode($token));
//
//        $uid = JwtToken::getCurrentId();
//        $email = JwtToken::getExtendVal('email');
//        // 刷新令牌
//        $refreshToken = JwtToken::refreshToken();
        return response_json(0,'success',$token);
    }

}
