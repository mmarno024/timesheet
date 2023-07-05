<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::get('/home', 'SywebController@index');
	Route::get('/sys_syweb_page', 'SywebController@page');
});
