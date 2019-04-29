<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/18
 * Time: 14:53
 */

namespace Blankphp\Event;

//观察者模式
use SplSubject;

abstract class EventAbstract implements \SplObserver
{
    private $status;
    protected static $observes = [];

    public function attach(ObserveAbstract $abstract, $name)
    {
        self::$observes[$name] = $abstract;
    }

    public function deattach($name)
    {
        //解除绑定关系
        unset(self::$observes[$name]);
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
            self::$observes[$this->status]->doListen();
        }
    }

    public function update(SplSubject $subject)
    {
        // TODO: Implement update() method.
    }
}