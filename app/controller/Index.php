<?php
namespace app\controller;

use support\Request;

class Index
{
    public function index(Request $request)
    {
        return json(['code' => 0, 'msg' => 'hello webman-admin']);
    }

    public function event(Request $request)
    {
        return json(['code' => 0, 'msg' => 'event']);
    }

}
