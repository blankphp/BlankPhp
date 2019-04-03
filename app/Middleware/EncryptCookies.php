<?php


namespace App\Middleware;


class EncryptCookies
{
    public static function handle($request, \Closure $next)
    {

        $next($request);

    }

}