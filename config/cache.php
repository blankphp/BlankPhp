<?php

return [
    'driver' => 'redis',

    'redis' => [
        'host' => '127.0.0.1',
        'port' => 6379,
        'password' => null
    ],
    'framework' => APP_PATH . '/cache/framework/',
    'file' => [
        'route' => APP_PATH . '/cache/framework/route.php',
        'config' => APP_PATH . '/cache/framework/config.php'
    ]
];