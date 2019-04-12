<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 18:50
 */

//应用目录为当前目录
define('APP_PATH', __DIR__ . '/');
define('APP_DEBUG', true);
define('APP_ENV', 'local');

//psr4自动加载
require(APP_PATH . '/vendor/autoload.php');

$app = require_once APP_PATH . 'Blankphp/Application.php';

$kernel = $app->make(\Blankphp\Contract\Kernel::class);
//核心处理请求--->dispatcher

$response = $kernel->handle(
    \Blankphp\Request\Facade\Request::capture()
);

//发送请求ob等
$response->send();
//清理空间,,容器内部消化



