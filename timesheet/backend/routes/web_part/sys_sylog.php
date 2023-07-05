<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_sylog', 'SylogController');
	Route::get('/sys_sylog_list', 'SylogController@getList');
	Route::get('/sys_sylog_lookup', 'SylogController@getLookup');
	Route::get('/sys_sylog_seelog/{trs}/{doc_no}', 'SylogController@seeLog');
});
