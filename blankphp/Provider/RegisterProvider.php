<?php


namespace Blankphp\Provider;


use Blankphp\Application;

class RegisterProvider
{
    protected $app;
    public function bootstrap(Application $app){
        $this->app=$app;
        $providers = $this->getProviders();
        $this->register($providers);
    }

    public function getProviders(){
        return config('app.providers');
    }

    public function register(array $providers){
        foreach ($providers as $provider)
            $this->app->call($provider);
    }



}