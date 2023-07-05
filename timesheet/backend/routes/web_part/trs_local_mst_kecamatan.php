<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/trs_local_mst_kecamatan', 'Mst_kecamatanController');
	Route::get('/trs_local_mst_kecamatan_list', 'Mst_kecamatanController@getList');
	Route::get('/trs_local_mst_kecamatan_lookup', 'Mst_kecamatanController@getLookup');
});