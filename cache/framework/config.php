<?php return array (
  'app' => 
  array (
    'APP_NAME' => 'test',
    'DEBUG' => true,
    'Provider' => 
    array (
    ),
  ),
  'db' => 
  array (
    'host' => 'localhost',
    'driver' => 'mysql',
    'port' => '3306',
    'charset' => 'utf8mb4',
    'database' => 'test',
    'username' => 'root',
    'password' => 'admin',
    'engine' => 'PDO',
  ),
  'route' => 
  array (
    'web' => 
    array (
      0 => 'TokenMiddleWare',
    ),
    'api' => 
    array (
      0 => 'JWTMiddleWare',
    ),
  ),
);