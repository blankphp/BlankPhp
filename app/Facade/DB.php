<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 18:55
 */

namespace App\Facade;


use App\Service\Mysql;
use App\Service\Oracle;
use Blankphp\Facade;

class DB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'db';
    }

}