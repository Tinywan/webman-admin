<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Webman\Route;
use app\controller\Authentication;
use app\controller\System;
use app\controller\Test;

Route::options('[{path:.+}]', function (){
    return response('');
});

// 1.0 身份认证
Route::group('/oauth', function () {
    Route::post('/issue-token', [Authentication::class, 'issueToken']); // 1.1 发行令牌
});

// 2.0 系统管理
Route::group('/system', function () {
    Route::get('/menu', [System::class, 'menu']); // 菜单
});

// test
Route::group('/test', function () {
    Route::get('/validate', [Test::class, 'validate']); // validate
    Route::get('/jwt', [Test::class, 'jwt']); // jwt
});

Route::fallback(function () {
    return response('');
});

Route::disableDefaultRoute();






