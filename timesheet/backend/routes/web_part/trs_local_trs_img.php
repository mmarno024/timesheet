<?php
Route::group(['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']], function () {
    Route::resource('/trs_local_trs_img', 'Trs_imgController');
    Route::get('/trs_local_trs_img_list', 'Trs_imgController@getList');
    Route::get('/trs_local_trs_img_detail', 'Trs_imgController@getDetail');
});
