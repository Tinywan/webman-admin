<?php
/**
 * @desc User.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/3/31 14:14
 */
declare(strict_types=1);


namespace app\rpc;

class Live
{
    public function getList(array $args)
    {
        return response_rpc_json(0, '获取直播列表', $args);
    }

    public function create(array $args)
    {
        return response_rpc_json(0, '创建直播', $args);
    }
}