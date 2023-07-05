<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_sygroup', 'SygroupController');
	Route::get('/sys_sygroup_list', 'SygroupController@getList');
	Route::get('/sys_sygroup_lookup', 'SygroupController@getLookup');
});