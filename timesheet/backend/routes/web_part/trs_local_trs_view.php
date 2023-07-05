<?php
Route::group(
    ['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']],
    function () {
        Route::resource('/trs_local_trs_view', 'Trs_viewController');
        Route::get('/trs_local_trs_view_ap', 'Trs_viewController@getAllprov');
        Route::get('/trs_local_trs_view_ap_data', 'Trs_viewController@getAllprovData');
        Route::get('/trs_local_trs_view_sp', 'Trs_viewController@getSingleprov');
        Route::get('/trs_local_trs_view_sp_data', 'Trs_viewController@getSingleprovData');
        Route::get('/trs_local_trs_view_ak', 'Trs_viewController@getAllkab');
        Route::get('/trs_local_trs_view_ak_data', 'Trs_viewController@getAllkabData');
        Route::get('/trs_local_trs_view_sk', 'Trs_viewController@getSinglekab');
        Route::get('/trs_local_trs_view_sk_data', 'Trs_viewController@getSinglekabData');
        Route::get('/trs_local_trs_view_list', 'Trs_viewController@getList');
        Route::get('/trs_local_trs_view_cek_all_data', 'Trs_viewController@getCheckAllData');
    }
);
