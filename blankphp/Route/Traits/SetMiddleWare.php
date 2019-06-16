<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/18
 * Time: 19:19
 */

namespace Blankphp\Route\Traits;


trait SetMiddleWare
{
    protected $tempMiddleware;
    protected $currentController;
    public $middleware;

    public function getMiddleWare()
    {
        return isset($this->middleware['alice'])?$this->middleware['alice']:'';
    }

    public function getGroupMidlleware()
    {
        return isset($this->middleware['group'])?$this->middleware['group']:'';
    }

    public function setMiddleWare($middleware)
    {
        $this->middleware = $middleware;
    }


    public function getOneMiddleWare($array)
    {
        //引用中间件别名[然后获取].
        if (isset($array['middleware']))
            return $array['middleware'];
        else
            return [];
    }

    public function setOneMiddleWare( $uri, $method)
    {
        if (!empty($this->tempMiddleware)) {
            $this->route[$uri][$method]['middleware']['alice']=[];
            array_push($this->route[$uri][$method]['middleware']['alice'], $this->tempMiddleware);
        }
    }

    public function setCurrentController($uri, $method)
    {
        $this->currentController = array($uri, $method);
    }

    public function getCurrentController()
    {
        return $this->currentController;
    }

    public function init()
    {
        $this->currentController = '';
    }
}