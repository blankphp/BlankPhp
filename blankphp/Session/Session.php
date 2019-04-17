<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/17
 * Time: 15:32
 */

namespace Blankphp\Session;


use Blankphp\Contract\Session as SessionContract;

class Session implements SessionContract
{
    public function __construct()
    {
        $name=config('app')['session']['driver'];
    }

    public function setSession($key,$value){

    }

    public function start(){

    }

    public function getSession(){

    }

    public function get($name){
       return $_SESSION[$name];
    }

}