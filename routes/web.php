<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 14:19
 */


Route::get('/', 'PagesController@index');

Route::post('/qq', 'QqController@index');
