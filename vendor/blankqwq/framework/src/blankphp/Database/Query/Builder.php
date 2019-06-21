<?php


namespace Blankphp\Database\Query;


use Blankphp\Database\Grammar\Grammar;
use Blankphp\Database\Grammar\MysqlGrammar;

class Builder
{
    //过滤sql增加一个values的东西和bindValues

    public $binds = [
        'select' => [],
        'from' => [],
        'join' => [],
        'update' => [],
        'where' => [],
        'having' => [],
        'order' => [],
        'union' => [],
        'insert' => [],
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
    public $values;
    public $type = 'select';
    public $createType='table';
    public $columns=[];
    public $limit;

    public function __construct(MysqlGrammar $grammar)
    {
        $this->grammar = $grammar;
    }

    public function addBinds($type, $value, $key = null)
    {
        if (!array_key_exists($type, $this->binds))
            throw new \Exception('无效的' . $type, 7);
        if (is_array($value)) {
            $this->binds[$type] = array_values(array_merge($this->binds[$type], $value));
        } else {
            if (is_null($key) || is_numeric($key))
                $this->binds[$type][] = $value;
            else
                $this->binds[$type][':' . $key] = $value;
        }
        return $this;
    }



    public function select($columns = [])
    {
        $this->select = ($columns == []) ? ['*'] : $columns;
        $this->addBinds('select', $columns);
        return $this;
    }


    public function where()
    {
        $args = func_get_args();
        $count = count($args);
        $column=$args[0];
        if ($count===2){
            $value=$args[1];
            $operators = '=';
        }elseif ($count===3){
            $operators = in_array($args[1], $this->operators) ? $args[1] : '=';
            $value=$args[2];
        }
        $this->wheres[] = sprintf("%s %s ?", $column, $operators);
        $this->addBinds('where', $value);
        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->orderBy[] = sprintf('%s %s', $column, $direction);
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
        return $this;
    }


    public function orWhere($column, $operator, $value)
    {
        $operators = in_array($operator, $this->operators) ? $operator : '=';
        $this->wheres[] = 'or';
        $this->wheres[] = sprintf("%s %s ?", $column, $operators);
        $this->addBinds('where', $value);
        return $this;
    }

    public function andWhere($column, $operator, $value)
    {
        $operators = in_array($operator, $this->operators) ? $operator : '=';
        $this->wheres[] = 'and';
        $this->wheres[] = sprintf("%s %s ?", $column, $operators);
        $this->addBinds('where', $value);
        return $this;
    }

    public function whereIn($array = [])
    {
        $value = implode(', ', $array);
        $this->wheres[] = sprintf("%s %s ?", 'id', 'in');
        $this->addBinds('where', $value);
        return $this;
    }

    public function limit(array $range = []){
        $value = implode(',', $range);
        $this->limit=$value;
        return $this;
    }


    public function insertSome(array $array)
    {
        $this->type = 'insert';
        $this->values[] = array_keys($array);
        foreach ($array as $key => $item) {
            if (!is_numeric($key))
                $this->addBinds('insert', $item, $key);
            else
                $this->addBinds('insert', $item);
        }
        return $this;
    }

    public function deleteSome($id = null)
    {
        $this->type = 'delete';
        if (!empty($id)) {
            $this->where('id', '=', $id);
        }
        return $this;
    }

    public function updateSome(array $values = [])
    {
        $this->type = 'update';
        if (!is_null($values)) {
            foreach ($values as $key => $value) {
                $this->values[] = sprintf("%s = ?", $key);
                $this->addBinds('update', $value);
            }
        }
        return $this;

    }

    public function toSql()
    {
        if ($this->type == 'select')
            return $this->grammar->generateSelect($this);
        elseif ($this->type == 'update')
            return $this->grammar->generateUpdate($this);
        elseif ($this->type == 'delete')
            return $this->grammar->generateDelete($this);
        elseif ($this->type == 'insert')
            return $this->grammar->generateInsert($this);
        elseif($this->type == 'create')
            return $this->grammar->generateCreate($this);
    }



    public function createTable($column,$type,$comment=''){
        $this->type='create';
        if (!empty($this->columns))
            $this->columns[] = sprintf("`%s` %s comment '%s'", $column, $type,$comment);
        else
            $this->columns[] = sprintf("`%s` %s ", $column, $type);
        return $this;
    }
}