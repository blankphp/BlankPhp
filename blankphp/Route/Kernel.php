<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 21:34
 */

namespace Blankphp;


class Kernel
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle()
    {
        echo 'kernel $this->app <<<< || <br>';

        var_dump($this->app);
        echo 'kernel $this->app <<<< || <br>';

        return $this->dispatchToRoute();
    }

    public function dispatchToRoute()
    {
        $route = $this->app->make('route');
        var_dump($route);
        return $this->app->make('route')->dispatch();
    }

}