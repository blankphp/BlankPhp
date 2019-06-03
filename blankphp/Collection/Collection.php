<?php


namespace Blankphp\Collection;


class Collection implements \ArrayAccess, \Iterator,\Countable
{
    public $item;
    public function __construct()
    {

    }

    public function toArray(){
        return array_map(function (){
            
        },$this->item);
    }


    public function count()
    {
        // TODO: Implement count() method.
    }

    public function offsetExists($offset)
    {

    }

    public function offsetGet($offset)
    {

    }


    public function offsetSet($offset, $value)
    {

    }

    public function offsetUnset($offset)
    {

    }


    public function current()
    {

    }


    public function next()
    {

    }


    public function key()
    {

    }

    public function valid()
    {

    }

    public function rewind()
    {

    }

}