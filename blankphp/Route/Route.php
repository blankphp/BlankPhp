<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 21:32
 */

namespace Blankphp\Route;

use Blankphp\Application;
use Blankphp\Route\Contract\Route as Contract;

class Route implements Contract
{
    public static $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    protected $route;


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

    public function dispatch()
    {
        return $this->runRoute($this->findRoute());
    }

    public function runRoute($route)
    {

    }

    public function findRoute()
    {
        //获取访问的uri

    }


}