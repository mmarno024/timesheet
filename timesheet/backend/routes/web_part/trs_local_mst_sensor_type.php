<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
    Route::get('/trs_local_mst_sensor_type_lookup', 'Mst_sensor_typeController@getLookup');
});
