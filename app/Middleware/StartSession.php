<?php


namespace App\Middleware;


use BlankPhp\Facade\Cookie;
use BlankPhp\Facade\Session;

class StartSession
{
    public function handle($request, \Closure $next)
    {
        if (APP_ENV != 'testing') {
            Session::start();
        }
        $response = $next($request);
        //存储和发送cookie
        if (APP_ENV != 'testing') {
            Session::end();
        }
        return $response;
    }
}