<?php


namespace Blankphp\Model\Traits;


trait CreateTable
{
    static $int=0;
    static $varchar=1;
    static $char=2;
    static $decimal=3;
    static $type=['int','varchar','char','decimal'];
    static $column=[];


    public static function column($name,array $option=[],$commant=''){
//        开始建列逻辑
        $data=[];
//        加入到数组中
        self::addColumn();
    }

    public static function addColumn($name,array $option){
//        开始建列逻辑
    }

    public static function createT(){
//        创建数据库
    }
}