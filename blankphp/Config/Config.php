<?php


namespace Blankphp\Config;


use Blankphp\Application;

class Config
{
    public  $config;
    public function __construct()
    {
        $app=Application::getInstance();
        $config= $app->getSignal('config');
        $app->unsetSignal('config');
        $this->config =$config;
    }

    public function get(array $descNames,$default){
        try{
            $config=$this->config;
            foreach ($descNames as $descName){
                $config=$config[$descName];
            }
            unset($descNames,$default);
            return $config;
        }catch (\Exception $exception){
            return $default;
        }
    }

    public function set($key,$value){

    }

}