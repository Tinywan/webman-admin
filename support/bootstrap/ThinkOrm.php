<?php
/**
 * @desc ThinkOrm.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/1/11 15:44
 */

declare(strict_types=1);

namespace support\bootstrap;

use think\facade\Db;
use Webman\Bootstrap;
use Workerman\Timer;

class ThinkOrm implements Bootstrap
{
    // 进程启动时调用
    public static function start($worker)
    {
        Db::setConfig(config('thinkorm'));
        if ($worker) {
            Timer::add(55, function () {
                $connections = config('thinkorm.connections', []);
                foreach ($connections as $key => $item) {
                    if ('mysql' == $item['type']) {
                        Db::connect($key)->query('select 1');
                    }
                }
            });
        }
    }
}