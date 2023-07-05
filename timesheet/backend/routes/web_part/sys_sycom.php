<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_sycom', 'SycomController');
	Route::get('/sys_sycom_list', 'SycomController@getList');
	Route::get('/sys_sycom_lookup', 'SycomController@getLookup');
});