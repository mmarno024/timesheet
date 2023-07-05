<?php

Route::group(['middleware' => ['web']], function () {
	Route::get('/libftp/{filename}', '\App\Sf@fileGet')->where('filename', '.+');
	Route::get('/libftp_list', '\App\Sf@fileList');
});

Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	// Route::get('/home', 'QcteshController@dash')->name('home');
	Route::get('/', 'HomeController@index')->name('home');
});

// Route::get('/', function () {
// 	// return view('welcome');
// 	return view('sys.system.sfhome');
// });

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/client', 'ClientController@index')->name('client');
	Route::get('/select_plant', function () {
		return \App\Sf::selectPlant();
	});
	Route::get('/libftp_auth/{filename}', '\App\Sf@fileGet')->where('filename', '.+');
	Route::get('/libftp_del/{filename}', '\App\Sf@fileDelete')->where('filename', '.+');
});

Route::group(['namespace' => 'Sys', 'middleware' => ['web']], function () {
	Route::get('/login', 'SystemController@sfLogin')->name('login');
	Route::post('/login', 'SystemController@sfLoginAuth')->name('login-auth');
	Route::get('/sflogout', 'SystemController@sfLogout');
});

Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::get('/sys_system_change_plant', 'SystemController@selectPlant');
	Route::get('/select_plant_set/{plant}', 'SystemController@selectPlantSet');
	Route::get('/set_user_attr', 'SystemController@setUserAttr');
	Route::get('/src', 'SystemController@srcPage');
	Route::get('/sys_system_src_page', 'SystemController@srcPage');
	Route::get('/sys_system_src_result', 'SystemController@srcResult');
	Route::get('/sys_system_personal_file', 'SystemController@sfPersonalFile');
	Route::get('/sys_system_about', 'SystemController@sfAbout');
	Route::post('/system/dialog', 'SystemController@getSfDialog');
	Route::get('/system/export_pdf', 'SystemController@exportPdf');
	Route::post('/upload_file', 'SystemController@uploadFile');
	Route::get('/delete_file', 'SystemController@deleteFile');
});
