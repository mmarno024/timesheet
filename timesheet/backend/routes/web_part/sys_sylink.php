<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_sylink', 'SylinkController');
	Route::get('/sys_sylink_list', 'SylinkController@getList');
	Route::get('/sys_sylink_lookup', 'SylinkController@getLookup');
	Route::get('/sys_sylink_dash', 'SylinkController@getDash');
	Route::post('/sys_sylink_audit', 'SylinkController@getAudit');
	Route::get('/sys_sylink_member', 'SylinkController@getMember');
	Route::get('/sys_sylink_cleanup', 'SylinkController@cleanUp');
});