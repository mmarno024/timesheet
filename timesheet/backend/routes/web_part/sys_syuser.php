<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_syuser', 'SyuserController');
	Route::get('/sys_syuser_list', 'SyuserController@getList');
	Route::get('/sys_syuser_lookup', 'SyuserController@getLookup');
	Route::get('/sys_syuser_syncldap', 'SyuserController@syncLdap');
	Route::post('/sys_syuser_change_pass', 'SyuserController@changePass');
	Route::get('/sys_system_profile', 'SyuserController@userProfile');
});