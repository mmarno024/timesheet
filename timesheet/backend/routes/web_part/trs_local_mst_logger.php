<?php
Route::group(
    ['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']],
    function () {
        Route::resource('/trs_local_mst_logger', 'Mst_loggerController');
        Route::get(
            '/trs_local_mst_logger_list',
            'Mst_loggerController@getList'
        );
        Route::get(
            '/trs_local_mst_logger_lookup',
            'Mst_loggerController@getLookup'
        );
        Route::get(
            '/trs_local_mst_logger_lookup2',
            'Mst_loggerController@getLookup2'
        );
    }
);

Route::group(['namespace' => 'Trs\Local'], function () {
    Route::get('/trs_local_mst_logger_data', 'Mst_loggerController@getData');
    Route::get('/trs_local_mst_logger_data2', 'Mst_loggerController@getData2');
    Route::get(
        '/trs_local_mst_hardware_runtext',
        'Mst_hardwareController@getRuntext'
    );
});
