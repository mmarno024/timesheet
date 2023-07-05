<?php
Route::group(
    ['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']],
    function () {
        Route::resource('/trs_local_trs_raw', 'Trs_rawController');
        Route::get('/trs_local_trs_raw_list', 'Trs_rawController@getList');
        Route::get('/trs_local_trs_raw_lookup', 'Trs_rawController@getLookup');
        Route::get('/trs_local_trs_raw_sensor', 'Trs_rawController@getSensor');
        Route::get('/trs_local_trs_raw_detail', 'Trs_rawController@getDetail');
        Route::get('/trs_local_trs_raw_detail_all', 'Trs_rawController@getDetailAll');
        Route::get('/trs_local_trs_raw_detail_list', 'Trs_rawController@getDetailList');
        Route::get('/trs_local_trs_raw_detail_list_all', 'Trs_rawController@getDetailListAll');
        Route::get('/trs_local_trs_raw_detail_pdf', 'Trs_rawController@getDetailPdf');
        Route::get('/trs_local_trs_raw_detail_all_pdf', 'Trs_rawController@getDetailPdfAll');
        Route::get('/trs_local_trs_raw_detail_xls', 'Trs_rawController@getDetailXls');
        Route::get('/trs_local_trs_raw_detail_all_xls', 'Trs_rawController@getDetailXlsAll');
    }
);
