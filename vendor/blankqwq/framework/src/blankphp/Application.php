<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 19:32
 */

namespace Blankphp;


use Blankphp\Cache\Driver\File;
use Blankphp\Config\Config;
use Blankphp\Contract\CookieContract;
use Blankphp\Cookie\Cookie;
use Blankphp\Database\Database;
use Blankphp\Database\Grammar\Grammar;
use Blankphp\Database\Grammar\MysqlGrammar;
use Blankphp\Kernel\HttpKernel;
use Blankphp\Request\Request;
use Blankphp\Response\Response;
use Blankphp\Route\Route;
use Blankphp\Scheme\Scheme;
use Blankphp\Session\Session;
use Blankphp\View\StaticView;
use Blankphp\View\View;

class Application extends Container
{

    public static function init()
    {
        return self::getInstance();
    }

    public function __construct()
    {
        //注册号一些服务
        $this->registerBase();
        $this->registerService();
        $this->registerProviders();
    }

    public function registerService()
    {
        if (is_file(APP_PATH . '/cache/framework/app.php')) {
            $this->binds = require APP_PATH . '/cache/framework/app.php';
        } else {
            foreach (
                [
                    'kernel' => [\Blankphp\Contract\Kernel::class, HttpKernel::class],
                    'request' => [\Blankphp\Contract\Request::class, Request::class],
                    'route' => [\Blankphp\Contract\Route::class, Route::class],
                    'app' => [\Blankphp\Contract\Container::class, Application::class],
                    'db' => Database::class,
                    'db.grammar' => [Grammar::class, MysqlGrammar::class],
                    'view' => [\Blankphp\Contract\View::class, View::class],
                    'view.static' => StaticView::class,
                    'cookie' => [CookieContract::class, Cookie::class],
                    'config' => Config::class,
                    'session' => [\Blankphp\Contract\Session::class, Session::class],
                    'scheme' => Scheme::class,
                    'response' => Response::class
                ]
                as $k => $v) {
                $this->bind($k, $v);
            }
        }

    }

    public function cacheBinds()
    {
        $file = new File();
        $file->putCache($this->binds, 'app.php');
    }

    public function make($abstract, $parameters = [])
    {
        if (!$this->has($abstract))
            if (class_exists($abstract))
                return new $abstract(...$parameters);
            else
                throw new \Exception('并没有找到这个标识或者类', 2);
        return parent::make($abstract, $parameters);
    }

    public function registerBase()
    {
        $this->instance('app', $this);
    }



    public function registerProviders()
    {
        $this->instance('route', $this->make('route'));
    }

    public function getSignal($abstract, $name = '')
    {
        if (empty($name))
            return isset($this->signal[$abstract]) ? $this->signal[$abstract] : [];
        else
            return isset($this->signal[$abstract][$name]) ? $this->signal[$abstract][$name] : [];
    }

    public function unsetSignal($abstract)
    {
        unset($this->signal[$abstract]);
    }

}


