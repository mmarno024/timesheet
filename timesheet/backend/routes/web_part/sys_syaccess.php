<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_syaccess', 'SyaccessController');
	Route::get('/sys_syaccess_list', 'SyaccessController@getList');
	Route::get('/sys_syaccess_lookup', 'SyaccessController@getLookup');
});