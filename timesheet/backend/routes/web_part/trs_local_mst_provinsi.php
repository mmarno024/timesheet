<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/trs_local_mst_provinsi', 'Mst_provinsiController');
	Route::get('/trs_local_mst_provinsi_list', 'Mst_provinsiController@getList');
	Route::get('/trs_local_mst_provinsi_lookup', 'Mst_provinsiController@getLookup');
});