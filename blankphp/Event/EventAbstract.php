<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/18
 * Time: 14:53
 */

namespace Blankphp\Event;

//观察者模式
abstract class EventAbstract
{
    private $status;
    protected $observes = [];

    public function attach(ObserveAbstract $abstract, $name)
    {
        $this->observes[$name] = $abstract;
    }

    public function deattach($name)
    {
        //解除绑定关系
        unset($this->observes[$name]);
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    //将状态推行到每一个观察者
    public function notify(){
        if (isset($this->observes[$this->status])){
            $this->observes[$this->status]->doListen();
        }
    }

}