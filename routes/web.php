<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 14:19
 */


Route::middleware('aa')->get('/', 'PagesController@index');
Route::get('/user', 'PagesController@getone');
