<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 14:19
 */

use \Blankphp\Route\Route;

Route::middleware('aa')->get('/', 'PagesController@index');
Route::get('/user/<id>/name/<id>', 'PagesController@getone');
