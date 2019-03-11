<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 14:18
 */
namespace App\Service;

use Blankphp\Application;

class Mysql
{

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function index(){
        var_dump($this->app);
        echo  "this is a mysql service index";
    }
}