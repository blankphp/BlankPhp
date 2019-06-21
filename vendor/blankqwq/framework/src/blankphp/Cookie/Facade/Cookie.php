<?php


namespace Blankphp\Cookie\Facade;


use Blankphp\Facade;

class Cookie extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cookie';
    }

}