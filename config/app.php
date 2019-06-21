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
    'timezone'=>'Asia/Shanghai',
    //url
    'url' => 'http://localhost/one',
    //模板文件地址
    'template' => 'resource/template',
    //静态文件地址
    'static' => 'static',
    //配置缓存采用file
    'configCache'=>'file',

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
    'exception_handler'=>\Blankphp\Exception\Handler::class,

    'providers' => [
        //核心服务提供者
        \App\Provider\AppServiceProvider::class,
        \App\Provider\RouteProvider::class,
        \App\Provider\MiddleWareProvider::class,
        //其他服务提供者
        
        //引入其他的服务
    ],


];