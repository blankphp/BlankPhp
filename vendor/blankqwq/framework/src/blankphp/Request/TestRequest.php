<?php


namespace Blankphp\Request;


class TestRequest extends Request
{
    protected static $instance;
    public function __construct()
    {
        return $this;
    }
    public static function create($method, $uri, $parameters, $cookies,
                           $files, $server, $content)
    {
        self::$instance=new self();
        self::$instance->uri=$uri;
        self::$instance->method=$method;
        self::$instance->request=$parameters;
        self::$instance->request['cookie']=$cookies;
        self::$instance->request['files']=$files;
        return self::$instance;
    }

}