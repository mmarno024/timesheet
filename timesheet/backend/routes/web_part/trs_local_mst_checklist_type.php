<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/trs_local_mst_checklist_type', 'Mst_checklist_typeController');
	Route::get('/trs_local_mst_checklist_type_list', 'Mst_checklist_typeController@getList');
	Route::get('/trs_local_mst_checklist_type_list2', 'Mst_checklist_typeController@getList2');
	Route::get('/trs_local_mst_checklist_type_data', 'Mst_checklist_typeController@getData');
	Route::get('/trs_local_mst_checklist_type_lookup', 'Mst_checklist_typeController@getLookup');
});
