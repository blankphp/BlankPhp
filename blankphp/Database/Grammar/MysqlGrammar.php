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

    public function generateSelect(Builder $sql,$parameter=[]){
        //拼装语句
        $sqlString='';
        //终极大拼装
        $sqlString.='select '.implode(',',$sql->select).' from '.$sql->table;
        if (!is_null($sql->wheres))
            $sqlString.=' where '.implode(' ',$sql->wheres);
        if (!is_null($sql->orderBy))
            $sqlString.='order by '.implode(' ',$sql->orderBy);
        return $sqlString;
    }

    public function generateUpdate(Builder $sql,$parameter=[]){
        //拼装语句
        $sqlString='';
        //终极大拼装
        $sqlString.='update '.implode(',',$sql->select).' from '.$sql->table;
        if (!is_null($sql->wheres))
            $sqlString.=' where '.implode(' ',$sql->wheres);
        if (!is_null($sql->orderBy))
            $sqlString.='order by '.implode(' ',$sql->orderBy);
        return $sqlString;
    }

    public function generateDelete(Builder $sql,$parameter=[]){
        //拼装语句
        $sqlString='';
        //终极大拼装
        $sqlString.='delete '.implode(',',$sql->select).' from '.$sql->table;
        if (!is_null($sql->wheres))
            $sqlString.=' where '.implode(' ',$sql->wheres);
        if (!is_null($sql->orderBy))
            $sqlString.='order by '.implode(' ',$sql->orderBy);
        return $sqlString;
    }

    public function generateAlter(Builder $sql,$parameter=[]){

    }

    public  function generateInsert(Builder $sql,$parameter=[]){
        //拼装语句
        $sqlString='';
        //终极大拼装

        return $sqlString;
    }

}