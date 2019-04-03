<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 19:34
 */

namespace Blankphp\Model;


trait Sql
{
    protected $sql;

    protected $binds=[
        'select',
        'groupBy',
        'orderBy',
        'where',
        'from',
    ];

    public function createTable()
    {
        return $this;
    }

    public function get()
    {
        return $this;
    }

    public function all()
    {
        return $this;
    }

    public function limit()
    {
        return $this;

    }

    public function first()
    {
        return $this;

    }

    public function last()
    {
        return $this;

    }

    public function orderBy()
    {
        return $this;
    }

    public function getSql()
    {
        $this->sql = $this->binds['select'] . $this->binds['from'] .
            $this->binds['where'] . $this->binds['orderBy']  . $this->binds['groupBy'];
        return $this;
    }


}