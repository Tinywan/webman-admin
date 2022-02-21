<?php
/**
 * @desc Authorized
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/2/21 22:24
 */

declare(strict_types=1);

namespace app\common\security;

use Casbin\Exceptions\CasbinException;
use support\Log;
use Tinywan\Casbin\Permission;
use Tinywan\Jwt\JwtToken;

class Authorized
{
    /*
     * 不验证权限节点
     */
    private  $public_rule = [
        '/console/oss-security-token',
    ];

    /**
     * @return bool
     */
    public function check(): bool
    {
        try {
            $url = request()->path();
            if (in_array($url, $this->public_rule, true)) {
                return true;
            }
            $uid = JwtToken::getCurrentId();
            $action = request()->method();
            if (!Permission::enforce(strval($uid), $url, strtoupper($action))) {
                return false;
            }
        } catch (CasbinException $exception) {
            Log::error('Cabin 授权异常' . $exception->getMessage());
            return false;
        }
        return true;
    }
}