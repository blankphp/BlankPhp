<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 18:55
 */

return [
    'APP_NAME' => 'test',
    'url' => 'http://localhost/one',
    'static' => '',


    'template' => 'resource/template',
    'static' => 'public/static',

    'cookie'=>[
        'expires'=>time()+3600*24*7,
        'path'=>'/',
        'domain'=>null,
        'secure'=>false,
        'httponly'=>false
    ],
    'session'=>[
        'driver'=>'file',
        'domain'=>null,
        'secure'=>false,
    ],

    'Provider' => [

    ],

];