<?php
/**
 * @desc ThinkOrm
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/3/14 20:41
 */

declare(strict_types=1);

namespace support\bootstrap;

use think\facade\Db;
use Webman\Bootstrap;
use Workerman\Timer;

class ThinkOrm implements Bootstrap
{
    public static function start($worker)
    {
        Db::setConfig(config('thinkorm'));
        if ($worker) {
            Timer::add(55, function () {
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