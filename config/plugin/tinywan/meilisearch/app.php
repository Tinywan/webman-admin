<?php
return [
    'enable' => true,
    'meilisearch' => [
        'url' => 'http://127.0.0.1:7700',
        'key' => '',
        'guzzle' => [
            'headers' => [
                'charset' => 'UTF-8',
            ],
            'timeout' => 2
        ],
    ]
];