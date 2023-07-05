<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_syplant', 'SyplantController');
	Route::get('/sys_syplant_list', 'SyplantController@getList');
	Route::get('/sys_syplant_lookup', 'SyplantController@getLookup');
	Route::get('/sys_syplant_cek_data', 'SyplantController@getCekdata');
});