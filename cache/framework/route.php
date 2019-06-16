<?php return array (
  '/' => 
  array (
    'GET' => 
    array (
      'action' => 'PagesController@index',
      'middleware' => 
      array (
        'group' => 'web',
      ),
    ),
  ),
  '/user/<id>/name/<id>' => 
  array (
    'GET' => 
    array (
      'action' => 'PagesController@getone',
      'middleware' => 
      array (
        'group' => 'web',
      ),
    ),
  ),
  '/api/' => 
  array (
    'POST' => 
    array (
      'action' => 'PagesController@index',
      'middleware' => 
      array (
        'group' => 'api',
      ),
    ),
  ),
);