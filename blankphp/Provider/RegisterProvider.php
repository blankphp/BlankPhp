<?php


namespace Blankphp\Provider;




use Blankphp\Application;

class RegisterProvider
{
    protected $app;
    protected $providers;


    public function getProviders(){
        if (empty($this->providers))
            $this->providers =config('app.providers');
    }

    public function register(Application $app){
         $this->getProviders();
        foreach ($this->providers as $provider)
            $app->call($provider);
    }



}