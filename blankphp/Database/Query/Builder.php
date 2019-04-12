<?php


namespace Blankphp\Database\Query;


use Blankphp\Database\Grammar\Grammar;
use Blankphp\Database\Grammar\MysqlGrammar;

class Builder
{
    public $binds = [
        'select' => [],
        'from' => [],
        'join' => [],
        'where' => [],
        'having' => [],
        'order' => [],
        'union' => [],
    ];
    public $operators = [
        '=', '<', '>', '<=', '>=', '<>', '!=', '<=>',
        'like', 'like binary', 'not like', 'ilike',
        '&', '|', '^', '<<', '>>',
        'rlike', 'regexp', 'not regexp',
        '~', '~*', '!~', '!~*', 'similar to',
        'not similar to', 'not ilike', '~~*', '!~~*',
    ];

    public $wheres;
    public $join;
    public $select = ['*'];
    public $table;
    public $groupBy;
    public $orderBy;
    public $unions;
    public $grammar;

    public function __construct(MysqlGrammar $grammar)
    {
        $this->grammar = $grammar;
    }

    public function addBinds($type, $value)
    {
        if (!array_key_exists($type, $this->binds))
            throw new \Exception('无效的' . $type, 7);
        if (is_array($value)) {
            $this->binds[$type] = array_values(array_merge($this->binds[$type], $value));
        } else {
            $this->binds[$type][] = $value;
        }
        return $this;
    }

    public function select($columns = [])
    {
        $this->select = ($columns == []) ? ['*'] : $columns;
        $this->addBinds('select', $columns);
        return $this;
    }


    public function where($column, $operator, $value)
    {
        $operators = in_array($operator, $this->operators) ? $operator : '=';
        $this->wheres[] = sprintf("%s %s '%s'", $column, $operators, $value);
        $this->addBinds('where', $value);
        return $this;
    }


    public function orderBy($column, $direction = 'asc')
    {
        $this->orderBy[] = sprintf('%s %s', $column, $direction);
        $this->addBinds('order', $column);
        return $this;
    }


    public function groupBy($columns, $having)
    {
        $this->groupBy[] = [$columns, $having];
        return $this;
    }

    public function join($table, $on)
    {
        $this->join[] = sprintf('join %s on(%s)', $table, $on);
        return $this;
    }


    public function leftJoin($table, $on)
    {
        $this->join[] = sprintf('left join %s on(%s)', $table, $on);
        return $this;
    }

    public function rightJoin($table, $on)
    {
        $this->join[] = sprintf('right join %s on(%s)', $table, $on);
        return $this;
    }

    public function union(Builder $sql)
    {
        $this->unions = $sql;
        return $this;
    }

    public function from($table)
    {
        $this->table = $table;
        $this->addBinds('from', $table);
        return $this;
    }

    public function toSql()
    {
        return $this->grammar->generateSelect($this);
    }

    public function orWhere($column, $operator, $value)
    {
        $operators = in_array($operator, $this->operators) ? $operator : '=';
        $this->wheres[] = 'or';
        $this->wheres[] = sprintf("%s %s %s", $column, $operators, $value);
        $this->addBinds('where', $value);
        return $this;
    }

    public function andWhere($column, $operator, $value)
    {
        $operators = in_array($operator, $this->operators) ? $operator : '=';
        $this->wheres[] = 'and';
        $this->wheres[] = sprintf("%s %s %s", $column, $operators, $value);
        $this->addBinds('where', $value);
        return $this;
    }

    public function whereIn($array=[]){
        $value=implode(', ',$array);
        $this->wheres[] = sprintf("%s %s (%s)", 'id', 'in', $value);
        $this->addBinds('where', $value);
        return $this;
    }

}