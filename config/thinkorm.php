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
            'database' => 'webman',
            'username' => 'root',
            'password' => '123456',
            'hostport' => '3306',
            'params' => [],
            'charset' => 'utf8mb4',
        ]
    ]
];