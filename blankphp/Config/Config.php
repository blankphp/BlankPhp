<?php


namespace Blankphp\Config;


use Blankphp\Application;

class Config
{
    public  $config;
    protected  $configPath=APP_PATH.'config/';
    protected $app;
    public function __construct(Application $app)
    {
        $this->app=$app;
        $config= $this->loadConfig();
        $this->config =$config;
    }


    public function loadConfig(){
        //暂时耦合 -- 等会使用load解开耦合
        if (!is_file(APP_PATH.'cache/framework/config.php')) {
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
            $config=require APP_PATH.'cache/framework/config.php';
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