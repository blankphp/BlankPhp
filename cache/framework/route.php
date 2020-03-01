<?php return array (
  '/' => 
  array (
    'GET' => 
    array (
      'rule' => '/',
      'name' => '',
      'action' => 'PagesController@index',
      'middleware' => 
      array (
      ),
      'group' => 'api',
      'method' => 
      array (
        0 => 'GET',
      ),
    ),
  ),
  '/api' => 
  array (
    'POST' => 
    array (
      'rule' => '/api',
      'name' => '',
      'action' => 'PagesController@index',
      'middleware' => 
      array (
      ),
      'group' => 'web',
      'method' => 
      array (
        0 => 'POST',
      ),
    ),
  ),
);