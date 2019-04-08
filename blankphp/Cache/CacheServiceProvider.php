<?php


namespace Blankphp\Cache;


use Blankphp\Provider\Provider;
use Blankphp\Route\Route;

class CacheServiceProvider extends Provider
{
    protected $cacheHelper=[
       'config'=>'config.php',
        'route'=>'route.php'
    ];
    public function register()
    {
    }

    public function boot()
    {

    }

    public function reload(){
        foreach ($this->cacheHelper as $key=>$value){
            $this->app->signal($key,FileCache::get($value));
        }
    }




}