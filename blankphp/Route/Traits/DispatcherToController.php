<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 18:47
 */

namespace Blankphp\Route\Traits;


trait DispatcherToController
{

    public function findRoute($request)
    {
        //判断方法
        $method = $request->method;
        //获取访问的uri
        $uri = $request->uri;
        if (isset($this->route[$method][$uri])) {
            //获取控制器
            $controller = $this->getController($this->route[$method][$uri]);
            return $controller;
        }
        throw new \Exception('该路由暂无控制器', 5);
    }

    public function getController($controller)
    {
        $controller = explode('@', $controller);
        $controllerName = !is_null($controller[0]) ? $this->controllerNamespace.'\\'.$controller[0] : '';
        $method = !is_null($controller[1]) ? $controller[1] : '';
        if (!is_null($controllerName) || !is_null($method))
            return array($controllerName, $method);
        throw new \Exception('控制器方法错误', 4);
    }


    public function runController($controller, $method)
    {
        //解决方法的依赖
        $parameters = $this->resolveClassMethodDependencies(
            [], $controller, $method
        );
        $controller=new $controller;
        //获取控制器的对象,返回结果
        return $controller->{$method}(...array_values($parameters));
    }


    public function dispatch($request)
    {
        //路由分发
        return $this->runController(...$this->findRoute($request));
    }
}