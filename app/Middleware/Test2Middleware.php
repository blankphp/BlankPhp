<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 19:13
 */

namespace App\Middleware;


class Test2Middleware
{
    public static function handle($request, \Closure $next)
    {
        $next($request);

    }
}