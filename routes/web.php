<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 14:19
 */
use \Blankphp\Route\Route;

Route::get('/','PagesController@index');
Route::get('/1','PagesController@indx');

Route::get('/2','PagesController@get');

Route::get('/3',function (){
    echo "3333";
});