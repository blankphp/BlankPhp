<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 13:14
 */

namespace Blankphp\Request;


use Blankphp\Contract\RequestContract;

class Request implements RequestContract
{
    public $uri;
    public $method;
    public $request = [];
    public $session = [];
    public $cookie = [];

    public function __construct()
    {
        $this->createFromGlobal();
        $this->clear();
        $this->getUri();
        $this->getMethod();
    }

    public function stripSlashesDeep($value)
    {
        //递归方式解决不安全字符
        $value = is_array($value) ? array_map([$this, 'stripSlashesDeep'], $value) : stripslashes($value);
        return $value;
    }

    public function clear()
    {
        unset($_GET);
        unset($_POST);
        unset($_FILES);
        unset($_REQUEST);
    }

    public function createFromGlobal()
    {
        $this->request['get'] = !is_null($_GET) ? $this->stripSlashesDeep($_GET) : '';
        $this->request['post'] = !is_null($_POST) ? $this->stripSlashesDeep($_POST) : '';
        $this->request['files'] = !is_null($_FILES) ? $_FILES : '';
//        $this->session = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : [];
//        $this->cookie = !is_null($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : [];
    }


    public function capture()
    {
        return $this;
    }


    public function get(array $array)
    {
        //获取指定的数组元素
        $data = [];
        foreach ($this->request as $requests) {
            if (!empty($requests))
                foreach ($requests as $k => $v)
                    if (in_array($k, $array, true))
                        $data[$k] = $v;
        }
        return $data;
    }

    public function input($name)
    {
        foreach ($this->request as $requests) {
            if (!empty($requests))
                if (isset($requests[$name]))
                    return $requests[$name];
        }
    }

    public function getOne(string $str)
    {
        //获取指定的数组元素
        $data = [];
        foreach ($this->request as $requests) {
            if (!empty($requests))
                foreach ($requests as $k => $v)
                    if (strstr($k, $str)) {
                        $data[$k] = $v;
                        break;
                    }
        }
        return $data;
    }

    public function getUri()
    {
        if (is_null($this->uri)) {
            $url = $_SERVER['REQUEST_URI'];
            // 清除?之后的内容,计算？出现的位置position(定位)
            $position = strpos($url, '?');
            //是否截取其中的代码
            $url = $position === false ? $url : substr($url, 0, $position);
            $url = trim($url, '/');
            $urlArray = explode('/', $url);
            $urlArray = array_filter($urlArray);
            $file = explode('/', str_replace('\\', '/', APP_PATH . 'index.php'));
            $urlArray = array_diff($urlArray, $file);
            //去除两边的东西
            if ($urlArray) {
                $this->uri = '/' . implode('/', $urlArray);
            } else {
                $this->uri = '/';
            }
        }
        return $this->uri;

    }

    public function getMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST')
            $method = isset($this->request['post']['_method']) ? strtoupper($this->request['post']['_method']) : 'POST';
        $this->method = $method;
        return $this->method;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getCookie()
    {
        return $this->cookie;
    }

    public function file($name)
    {
        if (isset($this->request['files'][$name]))
            return $this->request['files'][$name];
    }

    public function __get($name)
    {
        if (!isset($this->$name)) {
            return $this->input($name);
        }
        return $this->$name;
    }


}