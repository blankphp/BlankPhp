<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/17
 * Time: 15:33
 */

namespace Blankphp\Cookie;


use Blankphp\Contract\CookieContract;


class Cookie implements CookieContract
{
    protected $expires = 0;
    protected $path = null;
    protected $domain = null;
    protected $secure = false;
    protected $httponly = false;

    public function __construct()
    {
        $option = config('app')['cookie'];
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

    public function set($key, $value, array $option = null)
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }
        if (!is_null($option)) {
            return setcookie($key, $value, ...$option
            );
        }
        return setcookie($key, $value, $this->expires, $this->path, $this->domain, $this->secure
            , $this->httponly
        );
    }

    public function get($name)
    {
        if (isset($_COOKIE[$name])) {
            return substr($_COOKIE[$name], 0, 1) == '{' ?
                json_decode($_COOKIE[$name]) :
                $_COOKIE[$name];
        }
    }


}