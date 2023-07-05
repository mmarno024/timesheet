<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
    Route::resource('/trs_local_mst_location', 'Mst_locationController');
    Route::get('/trs_local_mst_location_list', 'Mst_locationController@getList');
    Route::get('/trs_local_mst_location_lookup', 'Mst_locationController@getLookup');
});
