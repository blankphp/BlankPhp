<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 17:37
 */

namespace Blankphp\Database\Grammar;


use Blankphp\Database\Query\Builder;

class MysqlGrammar extends Grammar
{
    static $index = ['default'];

    public function generateSelect(Builder $sql, $parameter = [])
    {
        //依旧拼接
        //拼装语句
        $sqlString = '';
        //终极大拼装= = 没有过滤很致命
        $sqlString .= 'select ' . implode(',', $sql->select) . ' from ' . $sql->table;
        if (!is_null($sql->wheres))
            $sqlString .= ' where ' . implode(' ', $sql->wheres);
        if (!is_null($sql->orderBy))
            $sqlString .= 'order by ' . implode(' ', $sql->orderBy);
        return $sqlString;
    }

    public function generateUpdate(Builder $sql, $parameter = [])
    {
        //拼装语句
        $sqlString = '';
        //终极大拼装
        $sqlString .= 'update ' . implode(',', $sql->select) . ' from ' . $sql->table;
        if (!is_null($sql->wheres))
            $sqlString .= ' where ' . implode(' ', $sql->wheres);
        if (!is_null($sql->orderBy))
            $sqlString .= 'order by ' . implode(' ', $sql->orderBy);
        return $sqlString;
    }

    public function generateDelete(Builder $sql, $parameter = [])
    {
        //拼装语句
        $sqlString = '';
        //终极大拼装
        $sqlString .= 'delete from ' . $sql->table;
        if (!is_null($sql->wheres))
            $sqlString .= ' where ' . implode(' ', $sql->wheres);
        if (!is_null($sql->orderBy))
            $sqlString .= 'order by ' . implode(' ', $sql->orderBy);
        return $sqlString;
    }

    public function generateAlter(Builder $sql, $parameter = [])
    {

    }

    public function generateInsert(Builder $sql, $parameter = [])
    {
        //拼装语句
        $sqlString = '';
        //终极大拼装
//        insert  teacher values (default,'T20140101','test','男')
        if (!is_int(($keys = array_keys($sql->values))[0]))
            $sqlString .= 'insert ' . $sql->table . '(' . implode(',', $keys) . ')' . ' values';
        else
            $sqlString .= 'insert ' . $sql->table . ' values';

        foreach ($sql->values as $value) {
            $sqlString .= '(';
            foreach ($value as $item) {
                if (!in_array($item, self::$index))
                    $sqlString .= '\'' . $item . '\'' . ',';
                else
                    $sqlString .= $item . ',';
            }
            $sqlString = trim($sqlString, ',');
            //是否截取其中的代码
            $sqlString .= ')';
        }
        return $sqlString;
    }




}