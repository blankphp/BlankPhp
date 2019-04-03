<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/15
 * Time: 14:41
 */

namespace App\Provider;
use App\Middleware\EncryptCookies;
use App\Middleware\StartSession;
use App\Middleware\Test2Middleware;
use App\Middleware\TestMiddleWare;
use \Blankphp\Provider\MiddleWareProvider as BaseProvider;

class MiddleWareProvider extends BaseProvider
{
    protected $namespace = 'App\Middleware';
    //路由中间件
    protected $middleware = [
        TestMiddleWare::class,
    ];
    //注册中间件别名
    protected $registerMiddleware= [
        'test'=>TestMiddleWare::class,
        'test2'=>Test2Middleware::class,
    ];

    //中间件组合
    protected $groupMiddleware=[
        'web'=>[
            EncryptCookies::class,
            StartSession::class,
        ],
        'api'=>[
            EncryptCookies::class,

        ]
    ];

}