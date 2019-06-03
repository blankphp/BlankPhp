<?php


namespace Blankphp\Exception;


abstract class Exception
{
    protected $message;
    protected $code;

    public function __construct()
    {

    }

    public function bootstrap(){

    }

    public function render(){
        //返回模板
    }

    public function handle(){
        //处理
    }

}