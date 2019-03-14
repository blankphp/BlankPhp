<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 9:04
 */

namespace Blankphp\Provider;


use Blankphp\Middleware\MiddleWare;

class MiddleWareProvider extends Provider
{

    protected $namespace = 'App\Middleware';
    protected $middleware = [
        MiddleWare::class,
    ];

    public function getMiddleware(){
        return $this->middleware;
    }

    public function boot()
    {
        $this->app->bind('middleware', $this);
    }

    public function register()
    {
        parent::register(); // TODO: Change the autogenerated stub
    }

    public function middleware()
    {
        //写出= =要加载的文件或者config中的中间件
    }

}