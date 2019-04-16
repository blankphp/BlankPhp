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
            //执行语句\
            $res = self::$pdo->query($this->sql->toSql());
            var_dump($res);
            return $res;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function get()
    {
        return $this->commit()->fetchAll();
    }

    public function create(array $value)
    {
        $this->sql->insertSome($value);
        $stmt = self::$pdo->prepare($this->sql->toSql());
        $stmt->execute();
        return self::$pdo->lastInsertId();
    }

    public function delete()
    {
        $args = func_get_args();
        foreach ($args as $arg) {
            if (is_array($arg)) {
                $this->sql->deleteSome($id = null, $arg);
            } elseif (is_numeric($arg)) {
                $this->sql->deleteSome($arg);
            }
        }
        $stmt = self::$pdo->prepare($this->sql->toSql());
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function find($id)
    {
        $this->sql->where('id', '=', $id);
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