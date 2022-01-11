<?php
declare(strict_types=1);

namespace app\controller;

use support\Request;
use think\facade\Db;
use Tinywan\Casbin\Permission;

class Test
{
    public function casbin(Request $request)
    {
        // adds permissions to a user
//        Permission::addPermissionForUser('eve', 'articles', 'read');
        // adds a role for a user.
//        Permission::addRoleForUser('eve', 'writer');
//        // adds permissions to a rule
//        Permission::addPolicy('writer', 'articles','edit');

        if (Permission::enforce("eve", "articles", "edit")) {
            echo '恭喜你！通过权限认证';
        } else {
            echo '对不起，您没有该资源访问权限';
        }
        return json(['code' => 0, 'msg' => 'event']);
    }

}
