<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 16:06
 */

namespace Blankphp\Route;


use Blankphp\Application;
use Blankphp\Response\Response;

class Router
{
    //对路由分发进行一个封装
    protected $route;
    protected $app;
    protected $middleware;

    public function __construct(Application $app, Route $route)
    {
        $this->route = $route;
        $this->app = $app;
        $this->middleware = $app->make('middleware');
    }

    public function getMiddleware()
    {
        $middleware = $this->app->make('middleware')
            ->getMiddleware($this->route->getGroupMidlleware());
        $temp = $this->app->make('middleware')->getAliceMiddleWare(
            $this->route->getMiddleWare());
        $this->middleware = array_filter(array_merge($middleware, $temp));
    }

    public function dispatcher($request)
    {
        ///寻找出request
        $controller = $this->route->findRoute($request);
        $this->getMiddleware();
        return (new Pipe($this->app))
            ->send($request)
            ->through($this->middleware)
            ->run(function ($request) use ($controller) {
                return $this->prepareResponse($request, $this->route->runController(...$controller));
            });
    }

    public function prepareResponse($request, $response)
    {
        return self::toResponse($request, $response);
    }

    public static function toResponse($request, $response)
    {
        $response = new Response($response);
        return $response->prepare($request);
    }




}