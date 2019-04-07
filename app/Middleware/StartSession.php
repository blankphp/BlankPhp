<?php


namespace App\Middleware;


class StartSession
{
    public static function handle($request, \Closure $next)
    {
        if (APP_ENV!= 'testing')
            session_start();
        return $next($request);

    }
}