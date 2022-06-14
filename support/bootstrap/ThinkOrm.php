<?php
/**
 * @desc ThinkOrm.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/11/9 15:13
 */


declare(strict_types=1);

namespace support\bootstrap;


use support\Cache;
use \think\facade\Db;
use Webman\Bootstrap;
use Workerman\Timer;

class ThinkOrm implements Bootstrap
{
    // 进程启动时调用
    public static function start($worker)
    {
        Db::setConfig(config('thinkorm'));
        // 开启字段缓存
        Db::setCache(Cache::instance());
        if ($worker) {
            Timer::add(10, function () {
                $connections = config('thinkorm.connections', []);
                foreach ($connections as $key => $item) {
                    if ($item['type'] == 'mysql') {
                        Db::connect($key)->query('select 1');
                    }
                }
            });
        }
    }
}