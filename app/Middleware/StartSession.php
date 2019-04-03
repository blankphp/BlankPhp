<?php


namespace App\Middleware;


class StartSession
{
    public static function handle($request, \Closure $next)
    {
        session_start();
        $next($request);

    }
}