<?php


namespace App\Middleware;


use Blankphp\Facade\Cookie;
use Blankphp\Facade\Session;

class StartSession
{
    public static function handle($request, \Closure $next)
    {
        if (APP_ENV != 'testing') {
//            是否需要在别处使用创建好session和cookie，因为大部分情况下都是需要使用的
            if (PHP_SESSION_ACTIVE !== session_status())
//                此处需要封装
                Session::start();
        }

        $response = $next($request);
//存储和发送cookie
        return $response;
    }
}