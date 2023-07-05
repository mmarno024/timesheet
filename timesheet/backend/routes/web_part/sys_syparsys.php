<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_syparsys', 'SyparsysController');
	Route::get('/sys_syparsys_list', 'SyparsysController@getList');
	Route::get('/sys_syparsys_lookup', 'SyparsysController@getLookup');
	Route::get('/sys_syparsys_disp', 'SyparsysController@getDisp');
	Route::post('/sys_syparsys_saveDash', 'SyparsysController@saveDash');
});