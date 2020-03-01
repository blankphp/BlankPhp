<?php


namespace App\Middleware;


use Blankphp\Facade\Cookie;
use Blankphp\Facade\Session;

class StartSession
{
    public function handle($request, \Closure $next)
    {
        if (APP_ENV != 'testing') {
            if (PHP_SESSION_ACTIVE !== session_status())
                Session::start();
        }
        $response = $next($request);
//存储和发送cookie
        return $response;
    }
}