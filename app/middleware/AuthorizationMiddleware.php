<?php
/**
 * @desc AuthorizationMiddleware
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/2/21 22:18
 */

declare(strict_types=1);

namespace app\middleware;


namespace app\middleware;

use Casbin\Exceptions\CasbinException;
use support\exception\ForbiddenHttpException;
use Tinywan\Casbin\Permission;
use Tinywan\Jwt\JwtToken;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class AuthorizationMiddleware implements MiddlewareInterface
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     * @throws ForbiddenHttpException
     */
    public function process(Request $request, callable $next): Response
    {
        $request->uid = JwtToken::getCurrentId();
        if (0 === $request->uid) {
            throw new ForbiddenHttpException();
        }
        try {
            $url = $request->path();
            $uid = JwtToken::getCurrentId();
            $superAdminMap = config('security')['super_admin_map'];
            Permission::addFunction('isSuperAdmin', function (string $key) use ($superAdminMap) {
                if (in_array($key, $superAdminMap, true)) {
                    return true;
                }
                return false;
            });
            $action = request()->method();
            if (!Permission::enforce(strval($uid), $url, strtoupper($action))) {
                return false;
            }
        } catch (CasbinException $exception) {
            throw new ForbiddenHttpException('Cabin 授权异常' . $exception->getMessage());
        }
        return $next($request);
    }
}