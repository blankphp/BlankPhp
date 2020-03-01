<?php return array (
  'app' => 
  array (
    'APP_NAME' => 'test',
    'timezone' => 'Asia/Shanghai',
    'url' => 'http://localhost/one',
    'template' => 'resource/template',
    'static' => 'static',
    'configCache' => 'file',
    'log_driver' => 'file',
    'cache' => 
    array (
    ),
    'cookie' => 
    array (
      'expires' => 1583677983,
      'path' => '/',
      'domain' => NULL,
      'secure' => false,
      'httponly' => false,
    ),
    'session' => 
    array (
      'name' => 'BlankPhp',
      'driver' => 'redis',
      'secure' => false,
      'expire' => 604800,
      'handler' => '\\Blankphp\\Session\\Driver\\Redis',
    ),
    'exception_handler' => 'Blankphp\\Exception\\Handler',
    'providers' => 
    array (
      0 => 'App\\Provider\\AppServiceProvider',
      1 => 'App\\Provider\\RouteProvider',
      2 => 'App\\Provider\\MiddleWareProvider',
    ),
    'alice' => 
    array (
      'Application' => 'Blankphp\\Facade\\Application',
      'Cache' => 'Blankphp\\Facade\\Cache',
      'Cookie' => 'Blankphp\\Facade\\Cookie',
      'DB' => 'Blankphp\\Facade\\DB',
      'Route' => 'Blankphp\\Facade\\Route',
      'Request' => 'Blankphp\\Facade\\Request',
      'Scheme' => 'Blankphp\\Facade\\Scheme',
      'Session' => 'Blankphp\\Facade\\Session',
      'Log' => 'Blankphp\\Facade\\Log',
      'Redis' => 'Blankphp\\Facade\\Redis',
    ),
  ),
  'cache' => 
  array (
    'driver' => 'redis',
    'redis' => 
    array (
      'host' => '127.0.0.1',
      'port' => 6379,
      'password' => NULL,
    ),
    'framework' => '/home/vagrant/chart/one//cache/framework/',
    'file' => 
    array (
      'route' => '/home/vagrant/chart/one//cache/framework/route.php',
      'config' => '/home/vagrant/chart/one//cache/framework/config.php',
    ),
  ),
  'db' => 
  array (
    'default' => 'mysql',
    'database' => 
    array (
      'mysql' => 
      array (
        'host' => '127.0.0.1',
        'driver' => 'mysql',
        'port' => '3306',
        'charset' => 'utf8mb4',
        'database' => 'test3',
        'username' => 'homestead',
        'password' => 'secret',
        'engine' => 'PDO',
      ),
      'redis' => 
      array (
        'host' => '127.0.0.1',
        'port' => 6379,
        'password' => NULL,
      ),
    ),
  ),
);