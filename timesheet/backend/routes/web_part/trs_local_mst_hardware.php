<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/trs_local_mst_hardware', 'Mst_hardwareController');
	Route::get('/trs_local_mst_hardware_list', 'Mst_hardwareController@getList');
	Route::get('/trs_local_mst_hardware_lookup', 'Mst_hardwareController@getLookup');
	Route::get('/trs_local_mst_hardware_lookup2', 'Mst_hardwareController@getLookup2');
	Route::get('/trs_local_mst_hardware_lookup3', 'Mst_hardwareController@getLookup3');
	Route::get('/trs_local_mst_hardware_lookup4', 'Mst_hardwareController@getLookup4');
	Route::get('/trs_local_mst_hardware_total_data', 'Mst_hardwareController@getTotaldata');
    Route::post('/trs_local_mst_hardware_fdel', 'Mst_hardwareController@forceDeleteHardware');
});
