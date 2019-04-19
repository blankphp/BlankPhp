<?php


namespace App\Middleware;


use Blankphp\Cookie\Facade\Cookie;

class StartSession
{
    public static function handle($request, \Closure $next)
    {
        if (APP_ENV != 'testing')
            if (empty($request->getSession()) &&  empty(Cookie::get(session_name())))
                session_start();
        return $next($request);
    }
}