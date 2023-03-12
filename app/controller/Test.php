<?php
/**
 * @desc 身份认证
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/19 16:55
 */

declare(strict_types=1);

namespace app\controller;

use app\common\model\UserModel;
use app\common\validate\UserValidate;
use Casbin\WebmanPermission\Permission;
use process\workbunny\rqueue\live\QueueBuilder;
use support\Log;
use support\Request;
use support\Response;
use Tinywan\Jwt\JwtToken;
use Tinywan\Lock\RedisLock;
use Tinywan\Rpc\Client;
use Webman\Config;
use Yansongda\Pay\Pay;
use function Workbunny\WebmanRqueue\sync_publish;

class Test
{
    public function validate(Request $request)
    {
        $res = UserModel::where('id',20220005)
            ->cache('RestyRedis:'.UserModel::getTable())
            ->select();
        var_dump($res->toArray());
        sync_publish(QueueBuilder::instance(),'Hello!');
        return 'suss';
    }

    public function payment(Request $request)
    {
        // 1. 获取配置文件 config/payment.php
        $config = Config::get('payment');

        // 2. 初始化配置
        Pay::config($config);

        // 3. 网页支付
        $order = [
            'out_trade_no' => time(),
            'total_amount' => '88.88',
            'subject' => '沙箱支付测试',
            '_method' => 'get' // 使用get方式跳转
        ];
        Log::info('『支付宝』： '.json_encode($order));
        return Pay::alipay()->web($order)->getBody()->getContents();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function issueToken(Request $request):Response
    {
        $user = [
            'id' => 10086,
            'userName' => 'A20021',
            'dashboard' => 0,
            'role' => ["SA","admin","Auditor"],
        ];
        $res = JwtToken::generateToken($user);
//        $res = JwtToken::refreshToken();
        return response_json(0,'success',$res);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function refreshToken(Request $request):Response
    {
        $res = JwtToken::refreshToken();
        return response_json(0,'success',$res);
    }

    /**
     * @return Response
     */
    public function rpc():Response
    {
        $request = [
            'class'   => 'live',
            'method'  => 'create',
            'args'    => [
                [
                    'uid' => 2025,
                    'username' => 'Tinywan',
               ]
            ]
        ];
        $client = new Client('tcp://127.0.0.1:8889');
        $res = $client->request($request);

        return response_json(0,'success',$res);
    }

    /**
     */
    public function permission(Request $request)
    {
        $edit =$request->get('edit','edit');
        Permission::addRoleForUser('eve', 'writer');
        if (Permission::enforce("eve", "articles", $edit)) {
            return '恭喜你！通过权限认证';
        } else {
            return '对不起，您没有该资源访问权限';
        }
    }

    public function permission2(Request $request)
    {
        $param = $request->get('edit','edit');
        // adds permissions to a user
//        Permission::addPermissionForUser('eve', 'articles', 'read1');
//        // adds a role for a user.
//        Permission::addRoleForUser('eve', 'writer');
        // adds permissions to a rule
        Permission::addPolicy('writer', 'articles',$param);
        return 'success';
    }
}
