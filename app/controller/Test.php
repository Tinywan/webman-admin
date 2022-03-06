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
use support\exception\BusinessException;
use support\exception\MethodNotAllowedException;
use support\Request;
use Tinywan\ExceptionHandler\Exception\BadRequestHttpException;
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
        $uid = JwtToken::getCurrentId();
        return response_json(0,'success',[
            'uid'=>$uid,
            'mobile'=>JwtToken::getExtendVal('mobile'),
        ]);
    }

    public function refreshToken(Request $request)
    {
        $accessToken = JwtToken::refreshToken();
        return response_json(0,'success',$accessToken);
    }

    /**
     * 异常测试
     * @param Request $request
     */
    public function exceptionHandler(Request $request)
    {
        $param = $request->get();
        validate($param, UnauthorizedValidate::class . '.issue');
        return response_json(0,'success');
    }

}
