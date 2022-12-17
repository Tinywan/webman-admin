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
use Casbin\WebmanPermission\Permission;
use Tinywan\ExceptionHandler\Exception\ForbiddenHttpException;
use Tinywan\ExceptionHandler\Exception\UnauthorizedHttpException;
use Tinywan\Jwt\JwtToken;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class AuthorizationMiddleware implements MiddlewareInterface
{
    /**
     * @param Request $request
     * @param callable $handler
     * @return Response
     * @throws ForbiddenHttpException|UnauthorizedHttpException
     */
    public function process(Request $request, callable $handler): Response
    {
        $request->uid = JwtToken::getCurrentId();
        if (0 === $request->uid) {
            throw new UnauthorizedHttpException();
        }
        try {
            $url = $request->path();
            $action = request()->method();
            if (!Permission::enforce(strval($request->uid), $url, strtoupper($action))) {
                throw new ForbiddenHttpException();
            }
        } catch (CasbinException $exception) {
            throw new ForbiddenHttpException($exception->getMessage());
        }
        return $handler($request);
    }
}