<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 19:46
 */

namespace Blankphp\Facade;


use Blankphp\Facade;

class Application extends Facade
{
    protected static function getFacadeAccessor()
    {
       return 'app';
    }

}