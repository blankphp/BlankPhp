<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 21:39
 */

namespace App\Provider;


use Blankphp\Application;
use Blankphp\Provider\Provider;
use \Blankphp\Route\Contract\Route;

class RouteProvider extends Provider
{

    protected $namespace = 'App\Controllers';
    protected $route;

    public function boot()
    {
        $this->route = $this->app->make('route');
    }

    public function register()
    {
        parent::register(); // TODO: Change the autogenerated stub
    }

    public function map()
    {
        return $this->mapWebRoute();
    }

    public function mapWebRoute()
    {
        $this->route->setNamespace($this->namespace)
            ->group(APP_PATH . 'routes/web.php');
        var_dump( $this->app->make('request')->uri);

    }

}