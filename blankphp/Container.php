<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 14:19
 */

namespace Blankphp;


use App\Service\Mysql;
use App\Service\Oracle;


class Container
{
    //存储对象的类变量/静态变量
    protected static $instance;
    //共享实例在这里存放
    protected $instances=[];
    //绑定---》我们的服务[$abstract,$instance]
    protected $binds=[];

    //单例模式，一个对象重复使用
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function make($abstract,$parameters=[])
    {
        //如果这里有实例那么就直接返回注册好的共享实例
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        $class = $this->binds[$abstract];

        return (empty($parameters)) ? $this->build($class): new $class(...$parameters);
    }

    public function has($abstract)
    {
        return isset($this->binds[$abstract]) || isset($this->instances[$abstract]);
    }

    public function bind($abstract, $instance)
    {
        $this->binds[$abstract] = $instance;
    }

    public function instance($abstract, $instance)
    {
        unset($this->binds[$abstract]);
        $this->instances[$abstract] = $instance;
    }


    public function notInstantiable($concrete)
    {
        throw new \Exception("[$concrete] no Instanctiable",3);
    }

    public function build($concrete)
    {
        $reflector = new \ReflectionClass($concrete);
        if (!$reflector->isInstantiable()) {
            return $this->notInstantiable($concrete);
        }
        $constructor = $reflector->getConstructor();
        if (is_null($constructor) ) {
            return new $concrete;
        }

        if ($reflector->isInstantiable()) {
            // 获得目标函数
            $params=$constructor->getParameters();
            if (count($params) === 0)
                  return new $concrete();
            $paramsArray = $this->resolveDepends($constructor->getParameters());
            return $reflector->newInstanceArgs($paramsArray);
        }
    }

    public function resolveDepends($params=[])
    {
        // 判断参数类型
        foreach ($params as $key => $param) {
            if ($paramClass = $param->getClass()) {
                // 获得参数类型名称
                $paramClassName = $paramClass->getName();
                // 获得参数类型
                $args = $this->make($paramClassName);
                $paramArr[] = $args;
            }
            return $paramArr;
        }
    }


}



