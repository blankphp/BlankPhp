<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/15
 * Time: 14:48
 */

namespace Blankphp\Controller\Traits;


trait MiddlewareController
{
    //这里中间件加入到
    protected $middleware=[];
    public function getMiddleware(){
        return $this->middleware;
    }

    public function middleware(){
        //添加中间件
        $middleware = func_get_args();
        if (is_array($middleware))
            foreach ($middleware as $m)
                $this->middleware[]=$m;
        else
            $this->middleware[]=$middleware;
    }
}