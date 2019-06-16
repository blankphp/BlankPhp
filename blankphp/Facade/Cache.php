<?php


namespace Blankphp\Facade;


use Blankphp\Facade;

class Cache extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cache';
    }
}