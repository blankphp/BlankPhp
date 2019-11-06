<?php


namespace App\Models;


use Blankphp\Model\Model;
use \Blankphp\Scheme\Scheme;

class Message extends Model
{
    protected $primaryKey = 'id';
    protected $tableName='messages';
    //可填充字段，create根据此来定义
    protected $fillable=['name','password','email'];

    //定义字段,并创建表
    public static function createTable(){
        Scheme::create(function ($table){
           $table->column('id',['int','primary key','auto_increment'],'id');
           $table->column('name',['varchar','length'=>40,'not null'],'名称');
           $table->column('password',['varchar','length'=>255],'密码');
           $table->timestamps();
           $table->end();
       },'users');
    }

}