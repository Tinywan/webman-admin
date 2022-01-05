<?php
/**
 * @desc 身份认证
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/19 16:55
 */

declare(strict_types=1);

namespace app\controller;


use app\common\controller\BaseController;
use app\common\validate\UnauthorizedValidate;
use support\Request;
use support\Response;

class Authentication extends BaseController
{
    public function issueToken(Request $request): Response
    {
        $params = $request->post();
        $this->validate($params, UnauthorizedValidate::class . '.issue');
        $data = [
            'access_token' => time(),
            'user_info' => [
                'userId' => 10086,
                'userName' => 'Tinywan',
                'dashboard' => 0,
                'role' => ["SA","admin","Auditor"],
            ]
        ];
        return json(['code' => 0, 'msg' => 'success','data'=>$data]);
    }
}