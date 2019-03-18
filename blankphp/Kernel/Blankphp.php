<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 18:53
 * 框架的核心文件
 */

namespace Blankphp\Kernel;

use App\Provider\RouteProvider;
use Blankphp\Application;
use Blankphp\Kernel\Contract\Kernel;
use App\Provider\MiddleWareProvider;
use Blankphp\Route\Router;

class Blankphp implements Kernel
{
    protected $config = [];
    protected $app;
    protected $route;

    protected $bootstraps = [
        RouteProvider::class => 'map',
        MiddleWareProvider::class => 'middleware',
    ];

    //获取配置文件===
    public function __construct(Application $app, Router $route)
    {
        $this->app = $app;
        $this->route = $route;
    }

    public function registerInstanceRequest($request)
    {
        $this->app->instance('request', $request);
    }

    //处理请求===》返回一个response，这里交给route组件
    public function handle($request)
    {
        //共享root权限
        $this->registerInstanceRequest($request);
        //路由分发=  =这里得注册好route
        //注册三大基础服务
        $this->bootstrap();
        //请求分发
        return $this->route->dispatcher($request);
    }

    public function bootstrap()
    {
        //注册好基础服务---》路由等
        //调用RouteProvider
        $this->app->instance('route', $this->route);
        foreach ($this->bootstraps as $k => $method) {
            $this->app->call($k, $method);
        }
    }

    public function registerService($bootstrap)
    {
        $this->app->make($bootstrap);
    }


    public function flush()
    {
        $this->app->flush();
    }


}