<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 14:19
 */

use \Blankphp\Route\Route;

Route::get('/', 'PagesController@index');
Route::get('/11', 'PagesController@indx')->middleware('test2');


Route::get('/user/[id]', 'PagesController@indx')->middleware('test2');

