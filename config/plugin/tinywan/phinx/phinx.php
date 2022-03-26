<?php

$orm = require config_path().'/thinkorm.php';
$config = $orm['connections'][$orm['default']];

return
    [
        'paths' => [
            'migrations' => base_path().'/db/migrations',
            'seeds' => base_path().'/db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'development' => [
                'adapter' => 'mysql',
                'host' => $config['hostname'] ?? 'localhost',
                'name' => $config['database'] ?? 'development_db',
                'user' => $config['username'] ?? 'root',
                'pass' => $config['password'] ?? '',
                'port' => $config['hostport'] ?? '3306',
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];