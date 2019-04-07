<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 16:16
 */

namespace Blankphp\Route;


use Blankphp\PipeLine\PipeLine;

class Pipe extends PipeLine
{

    public function run(\Closure $closure)
    {
       return call_user_func(array_reduce($this->middleware, $this->getAlice(),$closure));
    }


}