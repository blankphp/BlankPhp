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
    '/image' => 
    array (
      'action' => 'ImageController@index',
      'middleware' => 
      array (
        'group' => 'web',
      ),
    ),
    '/user/<id>' => 
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
    '/api/image' => 
    array (
      'action' => 'ImageController@save',
      'middleware' => 
      array (
        'group' => 'api',
      ),
    ),
  ),
);