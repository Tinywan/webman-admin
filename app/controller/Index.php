<?php
namespace app\controller;

use extend\event\LogErrorWriteEvent;
use support\Request;
use webman\event\EventManager;

class Index
{
    public function index(Request $request)
    {
        return json(['code' => 0, 'msg' => 'hello webman-admin']);
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
