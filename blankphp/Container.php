<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 14:19
 */

namespace Blankphp;

use \Blankphp\Contract\Container as ContainerContract;


class Container implements \ArrayAccess, ContainerContract
{
    //存储对象的类变量/静态变量
    protected static $instance;
    //共享实例在这里存放
    protected $instances = [];
    protected $binds = [];
    protected $classes = [];
    protected $signal = [];


    //单例模式，一个对象重复使用
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function make($abstract, $parameters = [])
    {
        //如果这里有实例那么就直接返回注册好的共享实例
        if (isset($this->classes[$abstract])) {
            return $this->classes[$abstract];
        }
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        $class = $this->binds[$abstract];
        return (empty($parameters)) ? $this->build($class) : new $class(...$parameters);
    }

    public function has($abstract)
    {
        return isset($this->binds[$abstract]) || isset($this->instances[$abstract]) || isset($this->classes[$abstract]);
    }

    public function bind($abstract, $instance)
    {
        $this->binds[$abstract] = $instance;
    }

    public function signal($abstract, $instance)
    {
        $this->signal[$abstract] = $instance;
    }

    public function instance($abstract, $instance)
    {
        if (!isset($this->instances[$abstract]))
            $this->instances[$abstract] = $instance;
        if (!isset($this->classes[get_class($instance)]))
            $this->classes[get_class($instance)] = $instance;
        unset($this->binds[$abstract]);
    }


    public function notInstantiable($concrete)
    {
        throw new \Exception("[$concrete] no Instanctiable", 3);
    }

    public function build($concrete)
    {
        $reflector = new \ReflectionClass($concrete);
        if (!$reflector->isInstantiable()) {
            return $this->notInstantiable($concrete);
        }
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $concrete;
        }

        if ($reflector->isInstantiable()) {
            // 获得目标函数
            $params = $constructor->getParameters();
            if (count($params) === 0)
                return new $concrete();
            $paramsArray = $this->resolveDepends($constructor->getParameters());
            return $reflector->newInstanceArgs($paramsArray);
        }
    }

    /**
     * @param array $params
     * @return array
     * 解决依赖注入问题
     */
    public function resolveDepends($params = [])
    {
        // 判断参数类型
        foreach ($params as $key => $param) {
            if ($paramClass = $param->getClass()) {
                // 获得参数类型名称
                $paramClassName = $paramClass->getName();
                // 获得参数类型
                if (isset($this->classes[$paramClassName])) {
                    $args = $this->classes[$paramClassName];
                } else
                    if ($this->has($paramClassName))
                        $args = $this->make($paramClassName);
                    else
                        $args = $this->build($paramClassName);
                $paramArr[] = $args;
            }
        }
        return $paramArr;
    }


    /**
     * @param $instance
     * @param $method
     * @return mixed
     * call调用容器中指定的方法
     */
    public function call($instance, $method)
    {
        $instance = $this->build($instance);
        return $instance->$method();
    }


    public function flush()
    {
        $this->classes = [];
        $this->binds = [];
        $this->instances = [];
        $this->signal = [];
    }

    /**
     *  * 标识一个元素是否定义
     *  * @param offset
     *  */
    public function offsetExists($offset)
    {

    }

    /**
     *  * 返回一个元素的值
     *  * @param offset
     *  */
    public function offsetGet($offset)
    {

    }

    /**
     *  * 为一个元素的赋值
     *  * @param offset
     *  * @param value
     *  */
    public function offsetSet($offset, $value)
    {

    }

    /**
     *  * 删除一个元素
     *  * @param offset
     *  */
    public function offsetUnset($offset)
    {

    }


}



