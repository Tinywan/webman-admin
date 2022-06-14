<?php
/**
 * @desc thinkorm.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/1/11 15:21
 */

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'type' => 'mysql',
            'hostname' => 'dnmp-mysql',
            'database' => 'webman-admin',
            'username' => 'root',
            'password' => '123456',
            'hostport' => '3306',
            'params' => [],
            'charset' => 'utf8mb4',
            // 是否严格检查字段是否存在
            'fields_strict'   => true,
            // 是否需要断线重连
            'break_reconnect' => true,
            // 监听SQL
            'trigger_sql'     => false,
            // 开启字段缓存
            'fields_cache'    => false,
        ],
    ]
];