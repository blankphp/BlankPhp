<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 17:37
 */

namespace Blankphp\Database\Grammar;

//语法生成器
use Blankphp\Database\Query\Builder;

abstract class Grammar
{
    public abstract function generateSelect(Builder $sql,$parameter=[]);

    public abstract function generateUpdate(Builder $sql,$parameter=[]);

    public abstract function generateDelete(Builder $sql,$parameter=[]);

    public abstract function generateAlter(Builder $sql,$parameter=[]);

    public abstract function generateInsert(Builder $sql,$parameter=[]);
}