<?php


namespace Blankphp\Scheme;


use Blankphp\Database\Database;
use Blankphp\Database\Query\Builder;
use mysql_xdevapi\Exception;

class Scheme
{
    public function __construct(Database $database)
    {
        //创建连接,创建好Builder
    }

    public function instance(){

    }

    public function column($name,array $content=[],$comment=''){
        //拼接sql
    }

    public static function create(\Closure $closure){
        //1.获取本身对象，
        $that = new self();
        try{
            //注入到闭包中
            $closure($that);
            //生成创建表sql

            //创建

            //记录创建版本
        }catch (\Exception $exception){
            echo $exception;
        }
        return true;
    }

    public function timestamps(){
        //创建时间和修改时间
    }

    public function bind(){

    }

}