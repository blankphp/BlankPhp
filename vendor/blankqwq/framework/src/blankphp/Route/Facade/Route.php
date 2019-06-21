<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 21:33
 */

namespace Blankphp\Route\Facade;


use Blankphp\Facade;

class Route extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'route';
    }
}