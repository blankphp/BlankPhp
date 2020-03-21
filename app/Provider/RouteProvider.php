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

class RouteProvider extends Provider
{

    protected $namespace = 'App\Controllers';
    protected $route;

    public function boot()
    {
        $this->route = $this->app->make('route');
        $this->route->setNamespace($this->namespace);
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
            ->file(APP_PATH . 'routes/api.php');
    }


    public function mapWebRoute()
    {
        $this->route
            ->group('web')
            ->file(APP_PATH . 'routes/web.php');
    }

}