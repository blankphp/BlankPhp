<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 9:04
 */

use \Blankphp\Route\Route;

Route::get('/', 'PagesController@index');
Route::get('/11', 'PagesController@indx')->middleware('test2');

