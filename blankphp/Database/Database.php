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
        if (empty(self::$pdo = DbConnect::getPdo())) {
            $driver = config('db.default');
            $db = config('db.database.' . $driver);
            self::$pdo = DbConnect::pdo($db);
            $this->sql = $sql;
        }
    }

    /**
     * @return null
     */
    public function table($table)
    {
        $this->sql->from($table);
        return $this;
    }

    public function update(array $values = [])
    {
        $this->sql->updateSome($values);
        return $this->commit()->rowCount();
    }

    protected function beginTransaction()
    {
        self::$pdo->beginTransaction();
    }

    protected function commitTransaction()
    {
        self::$pdo->commit();
    }

    protected function rollBack()
    {
        self::$pdo->rollBack();
    }

    final function transaction(\Closure $closure)
    {
        try {
            $this->beginTransaction();
            $closure();
            $this->commitTransaction();
        } catch (\PDOException $exception) {
            $this->rollBack();
        }
    }

    public function all(){


    }

    public function commit()
    {
        try {
            //执行语句\
            $smt = self::$pdo->prepare($this->sql->toSql());
            $this->PDOsmt = $smt;
            $procedure = in_array(substr($smt->queryString, 0, 4), ['exec', 'call']);
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
        //这样只有单一的数据，需要重复的创建然后保存到一个大collection
        return $this->commit()->fetchObject(Collection::class);
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
        if (empty($args)) {
            $this->sql->deleteSome();
        }

        return $this->commit()->rowCount();
    }

    public function find($id)
    {
        $this->sql->where('id', '=', $id);
        $this->limit(1);
        return $this->commit()->fetchObject(Collection::class);
    }

    public function limit(){
        $args = func_get_args();
        $count = count($args);
        if ($count>2)
            throw new \Exception('错误的范围');
        elseif ($count==1)
            $this->sql->limit([0,$args[0]]);
        elseif ($count==2)
            $this->sql->limit($args);
        return $this;

    }

    public function __set($name, $value)
    {
        //修改或者创建某个表中的元素..得判断有没有获取到目标id

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
        $i=0;
        foreach ($values as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $k => $item) {
                    $b = is_numeric($k) ? ++$i : $k;
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