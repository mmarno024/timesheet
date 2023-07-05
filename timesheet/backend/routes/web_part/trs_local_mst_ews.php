<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/trs_local_mst_ews', 'Mst_ewsController');
	Route::get('/trs_local_mst_ews_list', 'Mst_ewsController@getList');
	Route::get('/trs_local_mst_ews_lookup', 'Mst_ewsController@getLookup');
	Route::get('/trs_local_mst_ews_lookup2', 'Mst_ewsController@getLookup2');
});
