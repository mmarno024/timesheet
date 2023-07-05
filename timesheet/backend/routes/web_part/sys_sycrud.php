<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_sycrud', 'SycrudController');
	Route::get('/sys_sycrud/fn/{fn}', 'SycrudController@fn');
	Route::post('/sys_sycrud/fn/{fn}', 'SycrudController@fn');
});