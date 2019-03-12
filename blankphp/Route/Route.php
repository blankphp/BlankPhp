<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 21:32
 */

namespace Blankphp\Route;

use Blankphp\Facade\Application;
use Blankphp\Route\Contract\Route as Contract;
use Blankphp\Route\Traits\DispatcherToController;
use Blankphp\Route\Traits\ResolveSomeDepends;


class Route implements Contract
{
    use ResolveSomeDepends, DispatcherToController;
    public static $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];
    protected $route;
    protected $app;
    protected $container;
    protected $controller;
    protected $controllerNamespace;

    public function __construct(Application $app)
    {
        $this->app=$app;
    }

    public function get($uri, $action)
    {
        return $this->addRoute(['GET'], $uri, $action);
    }

    public function post($uri, $action)
    {
        return $this->addRoute(['POST'], $uri, $action);
    }

    public function any($uri, $action)
    {
        return $this->addRoute(self::$verbs, $uri, $action);
    }

    public function addRoute($methods, $uri, $action)
    {
        foreach ($methods as $method) {
            $this->route[$method][$uri] = $action;
        }
        return $this;
    }

    public function middleware($group)
    {
        $this->controllerNamespace=$group;
        return $this;
    }

    public function group($file){
        require $file;
    }

    public function setNamespace($namespace){
        $this->controllerNamespace=$namespace;
        return $this;
    }



}