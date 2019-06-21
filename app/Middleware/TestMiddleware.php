<?php


namespace App\Middleware;


use Blankphp\Cookie\Facade\Cookie;
use Blankphp\Session\Facade\Session;

class TestMiddleware
{
    public static function handle($request, \Closure $next)
    {


        $response = $next($request);
//存储和发送cookie
        return $response;
    }
}