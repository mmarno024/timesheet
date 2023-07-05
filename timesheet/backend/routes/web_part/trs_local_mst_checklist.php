<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/trs_local_mst_checklist', 'Mst_checklistController');
	Route::get('/trs_local_mst_checklist_list', 'Mst_checklistController@getList');
	Route::get('/trs_local_mst_checklist_list2', 'Mst_checklistController@getList2');
	Route::get('/trs_local_mst_checklist_data', 'Mst_checklistController@getData');
	Route::get('/trs_local_mst_checklist_lookup', 'Mst_checklistController@getLookup');
});
