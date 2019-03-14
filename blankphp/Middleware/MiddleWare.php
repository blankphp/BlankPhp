<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 16:51
 */

namespace Blankphp\Middleware;


class MiddleWare
{
    public static function handle($request,\Closure $next)
    {
        if ($request->uri=='/'){
            $next();
        }else
            echo "错误404";
        //闭包成功
    }

}