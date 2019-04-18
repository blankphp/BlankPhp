<?php


namespace App\Middleware;


class StartSession
{
    public static function handle($request, \Closure $next)
    {
        if (APP_ENV != 'testing')
            if (is_null($request->getSession()))
                session_start();
        return $next($request);
    }
}