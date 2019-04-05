<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 19:32
 */

namespace Blankphp;


use \App\Provider\MiddleWareProvider;
use Blankphp\Contract\RequestContract;
use Blankphp\Database\Database;
use Blankphp\Kernel\Blankphp;
use Blankphp\Request\Request;
use Blankphp\Route\Route;

class Application extends Container
{
    public function __construct()
    {
        //把app放如共享实例容器中
        $this->registerBase();
        $this->registerService();
        $this->registerProviders();
    }

    public function registerService()
    {
        $binds = [
            'kernel' => Blankphp::class,
            'request' => Request::class,
            'route' => Route::class,
            'app' => Application::class,
            'db' => Database::class,
            \Blankphp\Contract\Container::class => Application::class,
            'middleware' => MiddleWareProvider::class,
            \Blankphp\Contract\Kernel::class => Blankphp::class,
            \Blankphp\Contract\Route::class => Route::class,
            RequestContract::class=>Request::class,
        ];
        foreach ($binds as $k => $v)
            $this->bind($k, $v);
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->signal[$abstract])) {
            return $this->signal[$abstract];
        }
        if (!$this->has($abstract))
            if (class_exists($abstract))
                return new $abstract(...$parameters);
            else
                throw new \Exception('并没有找到这个标识或者类', 2);
        return parent::make($abstract);
    }

    public function registerBase()
    {
        $this->instance('app', $this);

    }

    public function registerProviders()
    {
        $this->instance('route', $this->make('route'));
    }


}

return Application::getInstance();

