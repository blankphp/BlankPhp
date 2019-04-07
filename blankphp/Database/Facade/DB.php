<?php


namespace Blankphp\Database\Facade;


use Blankphp\Facade;

class DB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'db';
    }

}