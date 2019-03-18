<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/15
 * Time: 14:42
 */

namespace App\Middleware;


class TestMiddleWare
{
    public static function handle($request, \Closure $next)
    {
        $next();
    }

}