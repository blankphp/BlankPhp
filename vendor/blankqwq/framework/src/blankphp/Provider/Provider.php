<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 10:14
 */

namespace Blankphp\Provider;


use Blankphp\Application;
use Blankphp\Provider\Contract\ProviderContract;

class Provider implements ProviderContract
{
    protected $app;

    public function __construct()
    {
        $this->app = Application::getInstance();
        $this->boot();
        $this->register();
    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

    public function register()
    {
        // TODO: Implement register() method.
    }

}