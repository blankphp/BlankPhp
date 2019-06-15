<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 9:06
 */

namespace Blankphp\PipeLine;


use Blankphp\Contract\Container;

class PipeLine
{
    protected $middleware;
    protected $request;

    public function __construct()
    {
    }

    public function send($request)
    {
        $this->request = $request;
        return $this;
    }

    public function getAlice()
    {
        return function ($stack, $pipe) {
            return function () use ($stack, $pipe) {
                return $pipe::handle($this->request, $stack);
            };
        };
    }

    public function through($middleware)
    {
        //管道模式运行
        $this->middleware = is_array($middleware) ? $middleware : func_get_args();
        return $this;
    }

}