<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 11:24
 */

namespace Blankphp\Model;


use Blankphp\Database\Database;
use Blankphp\Event\EventAbstract;
use Blankphp\Model\Traits\CreateTable;
use SplSubject;

class Model extends EventAbstract
{
    use CreateTable;
    protected $database;
    protected $tableName;
    protected $primaryKey;
    protected $fillable=[];
    //原来的数据
    public $origin;
    //真实数据
    public $data;


    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function save(){

    }

    public function builSql(){
//        生成sql语句

    }

    public function get(){
        //查询数据进行包裹
    }

    public function delete(){
        //删除指定数据
    }

    public function  create(){
//        创建创建指定数据
    }

    public function toArray(){
        //转化为数组
    }

    public function toJson(){
        //转化为json

    }

    public function __set($name, $value)
    {
        //设定一些未设定的属性

    }

    public static function observe(obj $obj){
        //把一个类注册到此类中

    }

    public function update(SplSubject $subject)
    {
        // TODO: Implement update() method.
    }

    //查询语句的核心--以及获取数据
    public function __call($name, $arguments)
    {
        $this->database->{$name}(...$arguments);
    }




}