<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 21:39
 */

namespace App\Provider;


use BlankPhp\Cache\Cache;
use BlankPhp\Cache\RouteCache;
use BlankPhp\Provider\Provider;
use BlankPhp\Route\Route;

class RouteProvider extends Provider
{

    protected $namespace = 'App\Controllers';
    protected $route;

    public function boot()
    {
        /** @var Route route */
        $this->route = $this->app->make('route');
        $this->map();
        parent::boot();
    }


    public function map()
    {
        $this->mapWebRoute();
        $this->mapApiRoute();
    }

    public function mapApiRoute()
    {
        $this->route
            ->group('api')
            ->prefix('api')
            ->namespace($this->namespace)
            ->file(APP_PATH . 'routes/api.php');
    }


    public function mapWebRoute()
    {
        $this->route
            ->group('web')
            ->namespace($this->namespace)
            ->file(APP_PATH . 'routes/web.php');
    }

}