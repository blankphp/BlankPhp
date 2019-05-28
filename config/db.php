<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 19:13
 */

return [
    'default'=>'mysql',

   'database'=>[
       'mysql'=>[
           'host' => '127.0.0.1',
           'driver'=>'mysql',
           'port' => '3306',
           'charset' => 'utf8mb4',
           'database' => 'test',
           'username' => 'root',
           'password' => 'admin',
           'engine' => PDO::class,
       ],


       'redis'=>[
           'host'=>'127.0.0.1',
           'port'=>'6379',
           'password'=>null
       ],
   ]
];