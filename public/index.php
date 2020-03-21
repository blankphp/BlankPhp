<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 18:50
 */

//应用目录为当前目录
use Blankphp\Application;
use Blankphp\Contract\Kernel;
use Blankphp\Facade\Request;

define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH', dirname(__DIR__) . DS);
define('APP_DEBUG', true);
define('APP_ENV', 'local');
//psr4自动加载
require APP_PATH . '/vendor/autoload.php';
//IOC
$kernel = Blankphp\Application::getInstance()->make(Blankphp\Contract\Kernel::class);
//http核心请求
$response = $kernel->handle(
    Blankphp\Facade\Request::capture()
);
//返回响应
$response->send();
//清理空间
