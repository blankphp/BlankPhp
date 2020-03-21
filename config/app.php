<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 18:55
 */

return [
    //系统名称
    'APP_NAME' => 'test',
    //时区
    'timezone' => 'Asia/Shanghai',
    //url
    'url' => 'http://localhost/one',
    //模板文件地址
    'template' => 'resource/template',
    //静态文件地址
    'static' => 'static',
    //配置缓存采用file
    'configCache' => 'file',
    //日志存储方式
    'log_driver' => 'file',
    //cookie配置
    'cookie' => [
        'expires' => 3600 * 24 * 7,
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'httponly' => false
    ],

    //session配置
    'session' => [
        'name' => 'BlankPhp',
        'driver' => 'redis.default',
        'secure' => false,
        'expire' => 60 * 60 * 24 * 7,
    ],
    //异常处理
    'exception_handler' => \BlankPhp\Exception\Handler::class,
    'error_handler' => \BlankPhp\Exception\Handler::class,
    //服务提供者
    'providers' => [
        //核心服务提供者
        \BlankPhp\Driver\DriverProvider::class,
        \App\Provider\AppServiceProvider::class,
        \App\Provider\RouteProvider::class,
        \App\Provider\MiddleWareProvider::class,
        //其他服务提供者

        //引入其他的服务
    ],

    //别名配置
    'alice' => [
        'Application' => BlankPhp\Facade\Application::class,
        'Cache' => BlankPhp\Facade\Cache::class,
        'Cookie' => BlankPhp\Facade\Cookie::class,
        'DB' => BlankPhp\Facade\DB::class,
        'Route' => BlankPhp\Facade\Route::class,
        'Request' => BlankPhp\Facade\Request::class,
        'Scheme' => BlankPhp\Facade\Scheme::class,
        'Session' => BlankPhp\Facade\Session::class,
        'Log' => BlankPhp\Facade\Log::class,
        'Redis' => BlankPhp\Facade\Redis::class,
    ]

];