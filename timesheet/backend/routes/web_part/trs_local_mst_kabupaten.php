<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/trs_local_mst_kabupaten', 'Mst_kabupatenController');
	Route::get('/trs_local_mst_kabupaten_list', 'Mst_kabupatenController@getList');
	Route::get('/trs_local_mst_kabupaten_lookup', 'Mst_kabupatenController@getLookup');
});