<?php
declare(strict_types=1);

namespace app\controller;

use app\common\model\MessageModel;
use support\Request;
use support\Response;
use Tinywan\Jwt\JwtToken;

class Index
{
    /**
     * @param Request $request
     * @return Response
     */
    public function issueToken(Request $request):Response
    {
        $user = [
            'user_info' => [
                'userId' => 10086,
                'userName' => 'A20021',
                'dashboard' => 0,
                'role' => ["SA","admin","Auditor"],
            ]
        ];
        $res = JwtToken::generateToken($user);
        $res = JwtToken::refreshToken();
        return response_json(0,'success',$res);
    }

    public function event(Request $request)
    {
        $error = [
            'errorMessage' => '错误消息',
            'errorCode' => 500,
        ];
        return json(['code' => 0, 'msg' => 'event']);
    }

    public function casbin(Request $request)
    {
        return json(['code' => 0, 'msg' => 'event']);
    }

}
