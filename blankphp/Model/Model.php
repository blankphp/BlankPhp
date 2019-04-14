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

class Model extends EventAbstract
{
    use CreateTable;
    protected $database;
    protected $tableName;
    protected $primaryKey;



    public function __construct(Database $database)
    {
        $this->database = $database;
    }



    //查询语句的核心--以及获取数据
    public function __call($name, $arguments)
    {
        $this->database->{$name}(...$arguments);
    }


}