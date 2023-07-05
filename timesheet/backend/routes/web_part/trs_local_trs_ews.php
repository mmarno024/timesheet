<?php
Route::group(
    ['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']],
    function () {
        Route::resource('/trs_local_trs_ews', 'Trs_ewsController');
        Route::get('/trs_local_trs_ews_status', 'Trs_ewsController@getStatus');
    }
);
