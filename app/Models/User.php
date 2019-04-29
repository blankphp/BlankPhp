<?php


namespace App\Models;


use Blankphp\Model\Model;

class User extends Model
{
    protected $primaryKey = 'id';
    protected $tableName='users';
    //可填充字段，create根据此来定义
    protected $fillable=['name','password','email'];

    //定义字段
    public static function createTable(){
        //字段名加类型等约束
        self::column('id',['int','primary key','auto_increment'],'id');
        self::column('name',['varchar','length'=>128,'unique'],'邮箱');
        self::column('name',['varchar','length'=>40,'not null'],'名称');
        self::column('password',['varchar','length'=>255],'密码');
        self::column('timestamps');
        //创建表
        self::createT();
    }

}