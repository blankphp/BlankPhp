<?php


namespace Blankphp\Cache;


class Cache extends CacheAbstract
{
    protected $tag;
    protected static $dir = APP_PATH . 'cache/framework/';

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        //调用驱动的方法
        $this->getHandler()->$name(...$arguments);
    }

}