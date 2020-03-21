<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 19:13
 */

return [
    //数据库配置
    'default' => 'mysql',

    'database' => [
        'mysql' => [
            'host' => '127.0.0.1',
            'driver' => 'mysql',
            'port' => '3306',
            'charset' => 'utf8mb4',
            'database' => 'test3',
            'username' => 'homestead',
            'password' => 'secret',
            'engine' => PDO::class,
        ],

    ]
];