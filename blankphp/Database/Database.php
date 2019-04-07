<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/18
 * Time: 14:52
 */

namespace Blankphp\Database;


use Blankphp\Application;
use Blankphp\Database\Query\Builder;

class Database
{

    private static $pdo = null;
    protected $sql;
    protected $id;

    public function __construct(Application $app, Builder $sql)
    {
        $db = $app->getSignal('config')['db'];
        self::$pdo = DbConnect::pdo($db);
        $this->sql = $sql;
    }

    /**
     * @return null
     */
    public function table($table)
    {
        $this->sql->from($table);
        return $this;
    }

    public function commit()
    {
        try {
            //执行语句
            $res = self::$pdo->query($this->sql->toSql());
            return $res;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function get(){
        return $this->commit()->fetchAll();
    }

    public function find($id){
        $this->sql->where('id','=',$id);
        return $this->commit()->fetchAll();
    }


    public function __set($name, $value)
    {
        //修改或者创建某个表中的元素..得判断有没有获取到目标id
        // TODO: Implement __set() method.
    }

    public function __call($name, $arguments)
    {
        $this->sql->{$name}(...$arguments);
        return $this;
    }

}