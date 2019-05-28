<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 18:55
 */

return [
    'APP_NAME' => 'test',
    'TIME_ZONE'=>'RPC',

    'url' => 'http://localhost/one',
    'template' => 'resource/template',
    'static' => 'static',


    'cookie'=>[
        'expires'=>time()+3600*24*7,
        'path'=>'/',
        'domain'=>null,
        'secure'=>false,
        'httponly'=>false
    ],

    
    'session'=>[
        'name'=>'BlankPhp',
        'driver'=>'file',
        'secure'=>false,
    ],

    'Provider' => [
        \App\Provider\AppServiceProvider::class,
        \App\Provider\EventServiceProvider::class,
        \App\Provider\MiddleWareProvider::class,
        \App\Provider\RouteProvider::class,

        //其他服务提供者
        //引入其他的服务

    ],

];