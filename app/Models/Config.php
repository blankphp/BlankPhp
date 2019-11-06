<?php


namespace App\Models;


use Blankphp\Model\Model;
use \Blankphp\Scheme\Scheme;

class Config extends Model
{
    protected $primaryKey = 'id';
    protected $tableName='users';
    //可填充字段，create根据此来定义
    protected $fillable=['name','password','email'];



}