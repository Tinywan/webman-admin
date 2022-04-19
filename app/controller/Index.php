<?php
declare(strict_types=1);

namespace app\controller;

use support\Request;
use support\Response;

class Index
{
    /**
     * @param Request $request
     * @return Response
     */
    public function issueToken(Request $request):Response
    {
        $data = [
            'access_token' => time()
        ];
        return json(['code' => 0, 'msg' => 'success','data'=>$data]);
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
        var_dump(22222222);
        return json(['code' => 0, 'msg' => 'event']);
    }

}
