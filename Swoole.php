<?php


namespace Blankqwq\Swoole;

use Blankphp\Application;
use Swoole\Table;
use swoole_server;
use swoole_table;

class Swoole
{
    public $http;
    public $service;
    public $dir=__DIR__.'/';
    protected $kernel;
    public function __construct()
    {
        //新建server
        $server = new \swoole\http\server('0.0.0.0', 999);
        $server->set(array(
            'worker_num' => 4,    //worker process num
            'max_request' => 200,
        ));
        //绑定server
        $server->on('WorkerStart',[$this,'WorkerStart']);
        $server->on('Request',[$this,'Request']);
        $this->registeAll();
        $server->start();
        $this->http=$server;
    }

    public function registeAll(){
        define('APP_PATH',$this->dir);
        define('APP_DEBUG', true);
        define('APP_ENV', 'local');

    }

    public function WorkerStart($serv, $fd){
        //引入所需要的类以及文件
        require(APP_PATH . '/vendor/autoload.php');
        //psr4自动加载
    }


    public function Request($request, $response){
        //处理请求
        $uri = $request->server['request_uri'];
        if ($uri == '/favicon.ico') {
            $response->status(404);
            $response->end();
        }
        unset($_GET);
        if (!empty($request->get))
            foreach ($request->get as $key=>$value)
                $_GET[$key]=$value;

        unset($_POST);
        if (!empty($request->post))
            foreach ($request->post as $key=>$value)
                $_POST[$key]=$value;

        unset($_SERVER);
        if (!empty($request->server))
            foreach ($request->server as $key=>$value)
                $_SERVER[strtoupper($key)]=$value;

        unset($_FILES);
        if (!empty($request->files))
            foreach ($request->files as $key=>$value)
                $_FILES[$key]=$value;

        unset($_SESSION);
        if (!empty($request->session))
            foreach ($request->session as $key=>$value)
                $_SESSION[$key]=$value;
        unset($_COOKIE);
        if (!empty($request->cookie))
            foreach ($request->cookie as $key=>$value)
                $_COOKIE[$key]=$value;
        $app = Application::getInstance();
        $kernel = $app->make(\Blankphp\Contract\Kernel::class);
        //核心处理请求--->dispatcher

        ob_start();
        $responseContent =  $kernel->handle(
            \Blankphp\Request\Facade\Request::capture()
        );
        $responseContent->send();
        $content  =ob_get_contents();
        ob_clean();
        //发送请求ob等
        $response->end($content);
        //清理空间,,容器内部消化
        $kernel->flush();
    }



}

new Swoole();
