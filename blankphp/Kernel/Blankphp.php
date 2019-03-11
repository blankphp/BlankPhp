<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 18:53
 * 框架的核心文件
 */

namespace Blankphp\Kernel;

use Blankphp\Application;
use Blankphp\Kernel\Contract\Kernel;

class Blankphp implements Kernel
{
    protected $config = [];
    protected $app;
    protected $bootstraps = [

    ];

    //获取配置文件===
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function registerInstanceRequest($request)
    {
        $this->app->instance('request', $request);
    }

    //处理请求===》返回一个response，这里交给route组件
    public function handle($request)
    {
        $this->registerInstanceRequest($request);
        //注册三大基础服务
        $this->bootstrap();
        return $request;
    }

    public function bootstrap()
    {


    }


}