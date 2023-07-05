<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_syguide', 'SyguideController');
	Route::get('/sys_syguide_list', 'SyguideController@getList');
	Route::get('/sys_syguide_lookup', 'SyguideController@getLookup');
	Route::get('/sys_syguide_read', 'SyguideController@read');
	Route::get('/sys_syguide_read_bytag', 'SyguideController@readByTag');
});