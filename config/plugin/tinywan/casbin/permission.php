<?php
/**
 * @desc permission.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/01/11 20:20
 */
return [
    'default' => 'basic',
    'basic' => [
        # Model 设置
        'model' => [
            'config_type' => 'file',
            'config_file_path' => config_path() . '/plugin/tinywan/casbin/rbac-model.conf',
            'config_text' => '',
        ],
        # 适配器
        'adapter' => \Tinywan\Casbin\Adapter\DatabaseAdapter::class,
        'database' => [
            'connection' => '',
            'rules_table' => 'casbin_rule',
        ],
        # 多进程策略定时刷新时间，单位秒
        'policy_refresh_time' => 180
    ]
];