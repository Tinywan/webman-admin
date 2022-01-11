<?php
/**
 * @desc permission.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/01/11 20:20
 */
return [
    'basic' => [
        # Model 设置
        'model' => [
            'config_type' => 'file',
            'config_file_path' => config_path() . '/plugin/tinywan/casbin/basic-model.conf',
            'config_text' => '',
        ],
        # 适配器
        'adapter' => \Tinywan\Casbin\model\DatabaseAdapter::class,
        'database' => [
            'connection' => '',
            'rules_table' => 'sys_casbin_rule',
        ],
        # 多进程策略定时刷新时间，单位秒
        'policy_refresh_time' => 180
    ]
];