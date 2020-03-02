<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 19:13
 */

return [
    //数据库驱动
    'database' => [
        "default" => [
            'host' => '127.0.0.1',
            'driver' => 'mysql',
            'port' => '3306',
            'charset' => 'utf8mb4',
            'database' => 'test3',
            'username' => 'homestead',
            'password' => 'secret',
            'engine' => PDO::class,
        ]
    ],
    //redis驱动配置
    'redis' => [
        'default' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'password' => null
        ]
    ],
    //文件驱动配置
    "file" => [
        "default" => [
            "path" => APP_PATH . "cache/",
        ],
        "session" => [
            "path" => APP_PATH . "cache/kv",
            "prefix" => "session_",
        ],
    ]
];