<?php


namespace App\Middleware;


class StartSession
{
    public static function handle($request, \Closure $next)
    {
        if (APP_ENV!= 'testing' || is_null($_SESSION))
            session_start();
        return $next($request);
    }
}