<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/trs_local_mst_desa', 'Mst_desaController');
	Route::get('/trs_local_mst_desa_list', 'Mst_desaController@getList');
	Route::get('/trs_local_mst_desa_lookup', 'Mst_desaController@getLookup');
});