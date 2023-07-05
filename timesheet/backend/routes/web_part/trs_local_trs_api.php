<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
    Route::resource('/trs_local_trs_api', 'Trs_apiController');
    Route::get('/trs_local_trs_api_list', 'Trs_apiController@getList');
    Route::get('/trs_local_trs_api_lookup', 'Trs_apiController@getLookup');
    Route::get('/trs_local_trs_api_total_data', 'Trs_apiController@getTotaldata');
    Route::get('/trs_local_trs_api_active', 'Trs_apiController@getActive');
});
