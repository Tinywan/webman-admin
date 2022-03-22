<?php

/**
 * 数据库驱动切换中间件，通过 global $baseConnection 实现多站点支持
 * @author ShaoBo Wan (Tinywan)
 * @datetime 2020/12/18 17:15
 */

declare(strict_types=1);

namespace app\middleware;

use app\common\model\WebSiteModel;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class WebsiteMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request. function
     *
     * @param Request $request
     * @param callable $next
     *
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        $domain = $request->header()['x-site-domain'] ?? 'webman.tinywan.cn';
        $request->website = WebSiteModel::where(['domain' => $domain])
            ->cache($domain.WebSiteModel::getTable())
            ->value('code') ? : 'webman';
        return $next($request);
    }
}
