<?php


namespace Blankphp\Exception;


use Throwable;

abstract class Exception extends  \Exception
{
    protected $message;
    protected $code;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message,$code,$previous);
    }

    public function bootstrap(){

    }

    public function render(){
        //返回模板
        //判断是否是json

    }

    public function handle(){
        //处理
    }

}