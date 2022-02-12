<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 18:50
 */


define('APP_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
//psr4自动加载
require APP_PATH . '/vendor/autoload.php';

$app = BlankPhp\Application::init();
$app->signal(\BlankPhp\Contract\Kernel::class, \BlankPhp\Kernel\HttpKernel::class);
$kernel = $app->make(BlankPhp\Contract\Kernel::class);
$response = $kernel->handle(
    BlankPhp\Request\Request::capture()
);
//返回响应
$response->send();
