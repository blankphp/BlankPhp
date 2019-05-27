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
use Blankphp\Event\Observer;
use Blankphp\Model\Traits\CreateTable;
use SplSubject;

class Model extends EventAbstract
{
    protected $database;
    protected $tableName;
    protected $primaryKey;
    protected $fillable = [];
    //原来的数据
    protected $origin = [];
    //真实数据
    protected $data = [];
    //sql
    protected $sql;


    public function __construct(Database $database)
    {
        //建立连接
        $this->database = $database;
        //废弃的字段

        //设定好对应关系以及
    }

    public function save()
    {

    }

    public function observe(Observer $observer)
    {
        //根据信号进行指定更新

    }

    public function __set($name, $value)
    {
        //设定一些未设定的属性

    }


    public function update(SplSubject $subject)
    {
        // 发送信号
    }

    //查询语句的核心--以及获取数据
    public function __call($name, $arguments)
    {
        $this->database->{$name}(...$arguments);
    }

}