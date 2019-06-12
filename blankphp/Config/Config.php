<?php


namespace Blankphp\Config;


use Blankphp\Application;

class Config
{
    public  $config;
    protected  $configPath=APP_PATH.'config/';
    protected $app;
    public function __construct()
    {
        var_dump(1);
        $this->app=$app=Application::getInstance();
        $config= $this->loadConfig();
        $this->app->unsetSignal('config');
        $this->config =$config;
    }


    public function loadConfig(){
        if (empty($this->app->getSignal('config'))) {
            $config = [];
            if (is_dir($this->configPath)) {
                if ($dh = opendir($this->configPath)) {
                    while (($file = readdir($dh)) !== false) {
                        if (preg_match_all("/(.+?)\.php/", $file, $matches)) {
                            $config[$matches[1][0]] = require $this->configPath . $matches[0][0];
                        }
                    }
                    closedir($dh);
                }
            }
        }else{
            return $this->app->getSignal('config');
        }
        return $config;
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