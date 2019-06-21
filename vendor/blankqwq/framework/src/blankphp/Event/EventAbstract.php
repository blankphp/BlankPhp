<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/18
 * Time: 14:53
 */

namespace Blankphp\Event;


abstract class EventAbstract
{
    private $status;
    public static $observes ;

    public static function observe(Observer $observer)
    {
        //根据信号进行指定更新
        self::$observes = $observer;
    }
    public function deobserve($name)
    {
        //解除绑定关系
        self::$observes='';
//        unset([$name]);
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
        if (isset($this->observes)){
            self::$observes->{$this->status}($this);
        }
    }

    public function event($event)
    {
        $this->setStatus($event);
        $this->notify();
    }
}