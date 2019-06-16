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
use Blankphp\Config\Config;
use Blankphp\Config\LoadConfig;
use Blankphp\Contract\Kernel;
use Blankphp\Exception\Error;
use Blankphp\Log\LogServiceProvider;
use Blankphp\Provider\RegisterProvider;
use Blankphp\Route\Router;

class HttpKernel implements Kernel
{
    protected $config = [];
    protected $app;
    protected $route;

    protected $middleware = [];
    protected $groupMiddleWare = [];

    protected $bootstraps = [
        LoadConfig::class,
        Error::class,
        RegisterProvider::class,
    ];

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
        $this->app->instance('request', $request);
    }

    //处理请求===》返回一个response，这里交给route组件
    public function handle($request)
    {
        //注册服务
        $this->bootstrap();
        $this->registerRequest($request);
        return $this->route->dispatcher($request);
    }


    public function bootstrap()
    {
        //引导框架运行
        foreach ($this->bootstraps as $provider) {
            $this->app->call($provider, 'bootstrap',[$this->app]);
        }
    }

    public function registerService($bootstrap)
    {
        $this->app->make($bootstrap);
    }


    public function flush()
    {
        $this->route->flush();
        $this->app->flush();
    }


}