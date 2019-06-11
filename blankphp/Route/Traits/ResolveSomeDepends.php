<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 17:57
 */

namespace Blankphp\Route\Traits;


use Blankphp\Contract\RequestContract;
use Blankphp\Facade;
use Blankphp\Model\Model;
use Blankphp\Request\Request;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionParameter;

trait ResolveSomeDepends
{

    public function resolveClassMethodDependencies($parameters, $instance, $method)
    {
        //解决类方法的依赖-->反射解决
        if (!empty($parameters)){
            $parameters=$this->resolveMethodDependencies(
                $parameters, $instance !== 'Closure' ?
                new \ReflectionMethod($instance, $method) : new \ReflectionFunction($method)
            );
            return $parameters;
        }

        return $this->resolveMethodDependencies(
            $parameters, $instance !== 'Closure' ?
                new \ReflectionMethod($instance, $method) : new \ReflectionFunction($method)
        );

    }


    public function resolveMethodDependencies(array $parameters, ReflectionFunctionAbstract $reflector)
    {
        $instanceCount = 0;
        $values = array_values($parameters);
        foreach ($reflector->getParameters() as $key => $parameter) {
            $instance = $parameter->getClass();
            if (!is_null($instance)) {
                $instanceCount++;
                array_splice($parameters, $key, $instanceCount,
                    [$this->app->make($instance->getName(),[$values[$instanceCount]])]
                );
            } elseif (!isset($values[$key - $instanceCount]) &&
                $parameter->isDefaultValueAvailable()) {
                array_splice($parameters, $key, $instanceCount, [$parameter->getDefaultValue()]);
            }
        }
        return $parameters;
    }


}