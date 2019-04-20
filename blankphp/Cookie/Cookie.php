<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/17
 * Time: 15:33
 */

namespace Blankphp\Cookie;


use Blankphp\Contract\CookieContract;
use Blankphp\Request\Facade\Request;


class Cookie implements CookieContract
{
    protected $expires = 0;
    protected $path = null;
    protected $domain = null;
    protected $secure = false;
    protected $httponly = false;
    protected $cookie=[];

    public function __construct()
    {
        $option = config('app.cookie');
        $this->cookie=Request::getCookie();
        $this->setOption($option);
    }

    public function setOption($option)
    {
        foreach ($option as $k => $v) {
            if (isset($this->{$k})) {
                $this->{$k} = $v;
            } else {
                continue;
            }
        }
    }

    public function set($key, $value, $expires=null,$option = null)
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }
        if (!is_null($option)) {
            array_shift($option);
            return setcookie($key, $value,$expires, ...array_values($option)
            );
        }
        return setcookie($key, $value, $this->expires, $this->path, $this->domain, $this->secure
            , $this->httponly
        );
    }

    public function get($name)
    {
        if (!empty($this->cookie)) {
            return substr($this->cookie[$name], 0, 1) == '{' ?
                json_decode($this->cookie[$name]) :
                $this->cookie[$name];
        }
        return [];
    }


}