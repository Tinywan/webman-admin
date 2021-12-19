<?php
declare(strict_types=1);

namespace app\controller;

use extend\event\LogErrorWriteEvent;
use support\Request;
use support\Response;
use webman\event\EventManager;

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
        EventManager::trigger(new LogErrorWriteEvent($error),LogErrorWriteEvent::NAME);
        return json(['code' => 0, 'msg' => 'event']);
    }

}
