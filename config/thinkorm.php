<?php
/**
 * @desc thinkorm.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/1/11 15:21
 */

return [
    'default' => 'company',
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
        ],
        'company' => [
            'type' => 'mysql',
            'hostname' => 'rm-bp1b476e1uxk2uo8goo.mysql.rds.aliyuncs.com',
            'database' => 'new_shop_busionline_com',
            'username' => 'www',
            'password' => 'Hnf8QGIJxomVbiRH',
            'hostport' => '3306',
            'params' => [],
            'charset' => 'utf8mb4',
        ]
    ]
];