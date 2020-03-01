<?php


namespace App\Middleware;


use Blankphp\Facade\Cookie;
use Blankphp\Facade\Session;

class TestMiddleware
{
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
//存储和发送cookie
        return $response;
    }
}