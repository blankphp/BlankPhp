<?php


namespace Blankphp\Config;


use Blankphp\Application;

class LoadConfig
{
    public function load(Application $app)
    {
        if (!is_file(APP_PATH . 'cache/framework/config.php')) {
            $config= $this->loadConfigFile();
        } else {
            $config = require APP_PATH . 'cache/framework/config.php';
        }
        $app->instance('config',$config= new Config($config));
        date_default_timezone_set($config->get(['app','timezone'], 'Asia/Shanghai'));
        mb_internal_encoding('UTF-8');
    }

    public function loadConfigFile()
    {
        //暂时耦合 -- 等会使用load解开耦合
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

        return $config;
    }

}