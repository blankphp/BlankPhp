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
    use Sql;
    protected $database;



    public function __construct(Database $database)
    {
        $this->database = $database;
    }




}