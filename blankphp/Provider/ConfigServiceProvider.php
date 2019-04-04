<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 16:43
 */

namespace Blankphp\Provider;


use Blankphp\Config\ConfigServiceProvider as BaseProvider;

class ConfigServiceProvider extends BaseProvider
{
    protected $configPath=APP_PATH.'config/';

    public function filter()
    {
        $config = [];
        if (is_dir($this->configPath)) {
            if ($dh = opendir($this->configPath)) {
                while (($file = readdir($dh)) !== false) {
                    if (preg_match_all("/(.+?)\.php/", $file, $matches)) {
                        $config[$matches[1][0]] = require_once $this->configPath . $matches[0][0];
                    }
                }
                closedir($dh);
            }
        }

        $this->app->signal('config',$config);
    }


}