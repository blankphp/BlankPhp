<?php


namespace Blankphp\Kernel;


use Blankphp\Application;
use Blankphp\Config\LoadConfig;
use Blankphp\Exception\Error;
use Blankphp\Provider\RegisterProvider;
use Blankphp\Route\Router;

class ConsoleKernel
{
    protected $config = [];
    protected $app;
    protected $command=[
        'make'=>[
            'controller',
            'model',
            'middleware'
        ],
        'cache'=>[
            'config',
            'route',
            'clear'
        ],
        'service'=>[
            'start',
            'stop',
            'restart'
        ],
        'queue'=>[
            'work',
            'table',
            'flush'
        ]
    ];
    protected $bootstraps = [
        LoadConfig::class=>'load',
        Error::class=>'register',
        RegisterProvider::class=>'register',
    ];

    public function __construct(Application $app, array $command=[])
    {
        $this->app = $app;
        $this->command=array_merge($this->command,$command);
    }




    public function bootstrap()
    {
        //引导框架运行
        foreach ($this->bootstraps as $provider=>$method) {
            $this->app->call($provider, $method,[$this->app]);
        }
    }



    public function flush()
    {
        $this->route->flush();
        $this->app->flush();
    }


}