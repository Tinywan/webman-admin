<?php
/**
 * @desc permission.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/01/12 20:20
 */
return [
    'default' => 'basic',
    'basic' => [
        # Model 设置
        'model' => [
            'config_type' => 'file',
            'config_file_path' => config_path() . '/plugin/casbin/webman-permission/rbac-model.conf',
            'config_text' => '',
        ],
        # 适配器
        'adapter' => Casbin\WebmanPermission\Adapter\DatabaseAdapter::class,
        'database' => [
            'connection' => '',
            'rules_table' => 'casbin_rule',
            'rules_name' => null
        ],
    ]
];