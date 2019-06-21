<?php


namespace Blankphp\Model;
use \Blankphp\Collection\Collection as BaseCollection;

class Collection extends BaseCollection
{
    //模型查询的数据存储于此
    protected $relation = [];
    //原始数据
    protected $origin=[];



}