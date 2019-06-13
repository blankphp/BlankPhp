<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/15
 * Time: 14:41
 */

namespace App\Provider;
use App\Middleware\StartSession;
use \Blankphp\Provider\MiddleWareProvider as BaseProvider;

class MiddleWareProvider extends BaseProvider
{
    //假装是一个provider，实际上不是
    protected $namespace = 'App\Middleware';
    //路由中间件
    protected $middleware = [

    ];
    //注册中间件别名
    protected $registerMiddleware= [

    ];

    //中间件组合
    protected $groupMiddleware=[
        'web'=>[
            StartSession::class,
        ],
        'api'=>[

        ]
    ];

}