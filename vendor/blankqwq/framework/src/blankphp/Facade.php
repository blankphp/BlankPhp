<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 18:50
 */

namespace Blankphp;


abstract class Facade
{
    protected static $resolveFacadeInstances = [];

    protected static function getFacadeAccessor()
    {
        throw new \Exception('你没有指定的代理类', 1);
    }

    protected function clearResolveInstance($instance)
    {
        unset(static::$resolveFacadeInstances[$instance]);
    }

    protected function clearResolveInstances($instance)
    {
        static::$resolveFacadeInstances = [];
    }

    public static function resolveFacadeInstance()
    {
        $class = static::getFacadeAccessor();
        if (is_object($class))
            return $class;
        if (isset(static::$resolveFacadeInstances[$class]))
            return static::$resolveFacadeInstances[$class];
        return static::$resolveFacadeInstances[] = Application::getInstance()->make($class);
    }

    public static function __CallStatic($method, $args)
    {
        $obj = static::resolveFacadeInstance();
        //通过反射解决依赖
        return $obj->$method(...$args);
    }

}