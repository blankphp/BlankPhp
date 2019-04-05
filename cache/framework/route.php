<?php
return array (
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
    '/11' => 
    array (
      'action' => 'PagesController@indx',
      'middleware' => 
      array (
        'group' => 'web',
        'alice' => 
        array (
          0 => 'test2',
        ),
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
    '/api/' => 
    array (
      'action' => 'PagesController@index',
      'middleware' => 
      array (
        'group' => 'api',
      ),
    ),
    '/api/11' => 
    array (
      'action' => 'PagesController@indx',
      'middleware' => 
      array (
        'group' => 'api',
        'alice' => 
        array (
          0 => 'test2',
        ),
      ),
    ),
  ),
);