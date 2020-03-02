<?php

return [
    'driver' => 'redis.default',

    'framework' => APP_PATH . '/cache/framework/',

    'file' => [
        'route' => APP_PATH . '/cache/framework/route.php',
        'config' => APP_PATH . '/cache/framework/config.php'
    ]
];