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

class Model extends EventAbstract
{
    protected $database;

    protected $sql;
    protected $select;
    protected $groupBy;
    protected $orderBy;
    protected $where;
    protected $from;


    public function __construct(Database $database)
    {
        $this->database = $database;
    }


    public function createTable()
    {

    }

    public function get()
    {

    }

    public function all()
    {

    }

    public function limit()
    {

    }

    public function first()
    {

    }

    public function last()
    {

    }

    public function orderBy()
    {

    }

    public function getSql()
    {
        $this->sql = $this->select . $this->where .
            $this->from . $this->groupBy . $this->orderBy;
    }

}