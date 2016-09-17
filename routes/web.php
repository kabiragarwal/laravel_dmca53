<?php

Route::auth();

Route::get('/', 'PagesController@index');


Route::get('notices/create/confirm', 'NoticesController@confirm');
Route::resource('notices', 'NoticesController');
Route::get('/logout', 'Auth\LoginController@logout');
Route::auth();

Route::get('/home', 'HomeController@index');
