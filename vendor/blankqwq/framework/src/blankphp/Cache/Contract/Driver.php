<?php


namespace Blankphp\Cache\Contract;


interface Driver
{
    public function set($key, $value, $ttl=null );

    public function get($key, $default);

    public function remember($array,\Closure $closure);

    public function has($key);

}