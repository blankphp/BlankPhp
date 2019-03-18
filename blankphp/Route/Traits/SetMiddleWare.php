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
    protected $middleware;

    public function getMiddleWare()
    {
        return $this->middleware;
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

    public function setOneMiddleWare($group, $method, $uri)
    {
        if (!empty($this->tempMiddleware)) {
            $this->route[$group][$method][$uri]['middleware'] = $this->tempMiddleware;
        }
    }

    public function setCurrentController($group, $method, $uri)
    {
        $this->currentController = array($group, $method, $uri);
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