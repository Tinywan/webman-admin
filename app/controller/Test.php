<?php
/**
 * @desc 身份认证
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/19 16:55
 */

declare(strict_types=1);

namespace app\controller;

use app\common\validate\UnauthorizedValidate;
use support\Request;

class Test
{
    public function casbin(Request $request)
    {
        $data = [
            'name'  => 'Tinywan',
            'age'  => 24,
            'email' => 'Tinywan@163.com'
        ];
        validate($data,UnauthorizedValidate::class. '.issue');
//        if (Permission::enforce("eve", "articles", "edit")) {
//            echo '恭喜你！通过权限认证';
//        } else {
//            echo '对不起，您没有该资源访问权限';
//        }
        return json(['code' => 0, 'msg' => 'event']);
    }

}
