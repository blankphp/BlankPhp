<?php return array (
  'GET' => 
  array (
    '/' => 
    array (
      'action' => 'PagesController@index',
      'middleware' => 
      array (
        'group' => 'web',
      ),
    ),
    '/user/<id>/name/<id>' => 
    array (
      'action' => 'PagesController@getone',
      'middleware' => 
      array (
        'group' => 'web',
      ),
    ),
  ),
  'POST' => 
  array (
    '/api/' => 
    array (
      'action' => 'PagesController@index',
      'middleware' => 
      array (
        'group' => 'api',
      ),
    ),
  ),
);