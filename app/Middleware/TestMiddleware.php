<?php


namespace App\Middleware;


use BlankPhp\Facade\Cookie;
use BlankPhp\Facade\Session;

class TestMiddleware
{
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
//存储和发送cookie
        return $response;
    }
}