<?php


namespace App\Models;


use Blankphp\Model\Model;

class User extends Model
{
    protected $primaryKey = 'id';
    protected $tableName='users';
    protected $fillable=['name','password','email'];

    //定义字段
    public static function createTable(){
        //字段名加类型等约束
        self::column('id',[]);
        self::column('name',[]);
        self::column('password',[]);
        self::column('timestamps');
        //创建表
        self::createT();
    }

}