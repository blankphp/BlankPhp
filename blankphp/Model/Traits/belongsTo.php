<?php


namespace Blankphp\Model\Traits;


trait belongsTo
{

    public function belongTo($table,$localColumn,$foreignColumn){
        //表连接这里1：1就采用内连接,并把数据返回到Collection
        $this->database->join($table,$localColumn,$foreignColumn);
        //多就查询多条放入数据
    }

}