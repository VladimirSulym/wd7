<?php

define('DS', DIRECTORY_SEPARATOR);
//define('APP_PATH', __DIR__ . DIRECTORY_SEPARATOR . );
$appPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');

return [
    'app_path' => $appPath,
    'controllers_path' => $appPath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers',
    'db' => [
        'local' => [
            'host' => '127.0.0.1', // 'localhost'
            'port' => 5432,
            'login' => 'skinner',
            'password' => 'test',
            'name' => 'wd7'
        ],
        'db_node_1' => [
            
        ]
    ]
];