<?php
declare(strict_types=1);

namespace app\controller;

use app\common\model\MessageModel;
use Redislabs\Module\ReJSON\ReJSON;

class Test
{
    /**
     * @desc nacos 配置中心
     * @author Tinywan(ShaoBo Wan)
     */
    public function nacos()
    {
        var_dump(MessageModel::where('1=1')->select());
//        $client = \Workbunny\WebmanNacos\Client::channel();
//
//        /** 读取命名空间为 public 的配置文件 payment.php */
//        $payment = $client->config->get('payment.php', 'DEFAULT_GROUP');
//        var_dump($payment);
//
//        echo '读取命名空间配置文件' . PHP_EOL;
//
//        /** 读取命名空间为 java 的配置文件 application-dev.yml */
//        $application = $client->config->get('application-dev.yml', 'DEFAULT_GROUP', 'b34ea59f-e240-413b-ba3d-bb040981d773');
//        var_dump($application);

$redisClient = new \Redis();
$redisClient->connect('192.168.13.168',63789);
$reJSON = \Redislabs\Module\ReJSON\ReJSON::createWithPhpRedis($redisClient);
$res = $reJSON->set('Tinywan', '.', ['username'=>'Tinywan','age'=>25], 'NX');
        var_dump($res);
    }
}
