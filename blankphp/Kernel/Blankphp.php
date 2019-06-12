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
use App\Provider\MiddleWareProvider;
use Blankphp\Cache\CacheServiceProvider;
use Blankphp\Contract\Kernel;
use Blankphp\Route\Router;

class Blankphp implements Kernel
{
    protected $config = [];
    protected $app;
    protected $route;

    protected $bootstraps = [
        //日志组件

        //设置组件

        //异常组件
    ];


    //获取配置文件===
    public function __construct(Application $app, Router $route)
    {
        $this->app = $app;
        $this->route = $route;
    }



    public function registerRequestRouter($request)
    {
        $this->app->instance('request', $request);
        $this->app->instance('route', $this->route);

    }

    //处理请求===》返回一个response，这里交给route组件
    public function handle($request)
    {
        //共享root权限
        $this->registerRequestRouter($request);
        //注册三大基础服务
        $this->bootstrap();
        //注册其他服务
        $this->registerOther();
        //请求分发
        return $this->route->dispatcher($request);
    }

    public function registerOther(){
        //获取其他服务提供者
        $providers = config('app.providers');
        foreach ($providers as $provider) {
            $this->app->call($provider);
        }
    }

    public function bootstrap()
    {
        //引导框架运行
        foreach ($this->bootstraps as $provider) {
            $this->app->call($provider);
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