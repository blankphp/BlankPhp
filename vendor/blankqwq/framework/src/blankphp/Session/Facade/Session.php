<?php


namespace Blankphp\Session\Facade;


use Blankphp\Facade;

class Session extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'session';
    }
}