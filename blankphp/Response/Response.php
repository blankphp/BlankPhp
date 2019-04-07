<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 11:42
 */

namespace Blankphp\Response;


class Response
{
    protected $result;
    protected static $header = [
        'html' => 'Content-Type: text/html; charset=utf-8',
        'json' => 'Content-type: application/json',
        'text' => 'Content-Type: text/plain'
    ];

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function setHeader()
    {


    }

    public function header()
    {

    }

    public function setContent()
    {

    }

    public function send()
    {
        header("Cache-Control: public");
        header("Pragma: cache");
        $offset = 30 * 60 * 60 * 24; // cache 1 month
        $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
        if (!$this->is_json($this->result)) {
            header(self::$header['json']);
        } else {
            header(self::$header['html']);
        }
        header($ExpStr);
        var_dump($this->result);
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

    }

    public function prepare($request)
    {
        //准备好的结果返回给页面
        return $this;
    }

    function is_json($string)
    {
        json_encode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }


    public function returnSend(){
        return $this->result;
    }

}