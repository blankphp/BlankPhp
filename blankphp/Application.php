<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 19:32
 */

namespace Blankphp;


use \App\Provider\MiddleWareProvider;
use Blankphp\Config\Config;
use Blankphp\Contract\CookieContract;
use Blankphp\Contract\RequestContract;
use Blankphp\Cookie\Cookie;
use Blankphp\Database\Database;
use Blankphp\Database\Grammar\Grammar;
use Blankphp\Database\Grammar\MysqlGrammar;
use Blankphp\Kernel\Blankphp;
use Blankphp\Request\Request;
use Blankphp\Route\Route;
use Blankphp\Session\Session;
use Blankphp\View\StaticView;
use Blankphp\View\View;

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
            'kernel' => [\Blankphp\Contract\Kernel::class, Blankphp::class],
            'request' => [RequestContract::class, Request::class],
            'route' => [\Blankphp\Contract\Route::class, Route::class],
            'app' => [\Blankphp\Contract\Container::class, Application::class],
            'db' => Database::class,
            'db.grammar' => [Grammar::class,MysqlGrammar::class],
            'view' => [\Blankphp\Contract\View::class, View::class],
            'view.static' => StaticView::class,
            'cookie' => [CookieContract::class,Cookie::class],
            'config.get' => Config::class,
            'session' => [\Blankphp\Contract\Session::class,Session::class],
            'middleware' => MiddleWareProvider::class,
        ];
        foreach ($binds as $k => $v)
            $this->bind($k, $v);
    }

    public function make($abstract, $parameters = [])
    {
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

    public function getSignal($abstract)
    {
        return isset($this->signal[$abstract]) ? $this->signal[$abstract] : [];
    }

    public function unsetSignal($abstract)
    {
        unset($this->signal[$abstract]);
    }

}

return Application::getInstance();

