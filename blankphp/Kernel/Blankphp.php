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
use Blankphp\Contract\Kernel;
use Blankphp\Log\LogServiceProvider;
use Blankphp\Route\Router;

class Blankphp implements Kernel
{
    protected $config = [];
    protected $app;
    protected $route;
    protected $request;
    protected $bootstraps = [

        //日志组件
        LogServiceProvider::class,
        //路由组件
        RouteProvider::class
        //异常组件
    ];


    //获取配置文件===
    public function __construct(Application $app, Router $route)
    {
        $this->app = $app;
        $this->route = $route;
        $this->registerRouter();
    }



    public function registerRouter()
    {
        $this->app->instance('route', $this->route);
    }

    public function registerRequest($request)
    {
        $this->request=$request;
        $this->app->instance('request', $this->request);
    }

    //处理请求===》返回一个response，这里交给route组件
    public function handle($request)
    {
        //共享root权限
        //注册三大基础服务
        $this->bootstrap();
        //注册其他服务
        $this->registerOther();
        $this->registerRequest($request);
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
        $this->request=[];
        $this->route->flush();
        $this->app->flush();
    }




}