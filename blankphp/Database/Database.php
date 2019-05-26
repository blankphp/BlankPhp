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
use mysql_xdevapi\Exception;

class Database
{

    private static $pdo = null;
    protected $sql;
    protected $id = 'default';
    protected $collection;
    protected $PDOsmt;


    public function __construct(Builder $sql)
    {
        $db = config('db');
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

    public function beginTransaction()
    {
        self::$pdo->beginTransaction();
    }

    public function commitTransaction()
    {
        self::$pdo->commit();
    }

    public function rollBack()
    {
        self::$pdo->rollBack();
    }

    public function transaction(\Closure $closure)
    {
        try {
            $this->beginTransaction();
            $closure();
            $this->commitTransaction();
        } catch (\PDOException $exception) {
            $this->rollBack();
        }
    }

    public function commit()
    {
        try {
            //执行语句\
            $smt = self::$pdo->prepare($this->sql->toSql());
            $this->PDOsmt = $smt;
            $procedure = in_array(substr($smt->queryString, 0, 4), ['exec', 'call']);
            var_dump($smt->queryString);
            if ($procedure)
                $this->bindValues($this->sql->binds);
            else
                $this->bindValues($this->sql->binds);
            $smt->execute();
            return $this->PDOsmt;
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

        return $this->commit()->rowCount();
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

    //将数据进行绑定,,Connect?
    public function bindValues(array $values = [])
    {
        if (is_null($this->PDOsmt)) {
            throw new Exception('异常错误');
        }
        foreach ($values as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $k => $item) {
                    $b = is_numeric($k) ? $k + 1 : $k;
                    $this->PDOsmt->bindValue($b, $item);
                }
            }
        }
    }

    public function bindCall(array $values)
    {
        if (is_null($this->PDOsmt)) {
            throw new Exception('异常错误');
        }
        foreach ($values as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $k => $item) {
                    $b = is_numeric($k) ? $k + 1 : ':' . $k;
                    $this->PDOsmt->bindValue($b, $item);
                }
            }
        }
    }

}