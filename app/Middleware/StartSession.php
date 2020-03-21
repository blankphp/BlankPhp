<?php


namespace App\Middleware;


use Blankphp\Facade\Cookie;
use Blankphp\Facade\Session;

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