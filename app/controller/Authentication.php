<?php
/**
 * @desc 描述
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/19 16:55
 */

declare(strict_types=1);

namespace app\controller;


use support\Request;
use support\Response;

class Authentication
{
    public function issueToken(Request $request): Response
    {
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