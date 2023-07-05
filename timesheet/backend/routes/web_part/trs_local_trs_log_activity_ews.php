<?php
Route::group(
    ['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']],
    function () {
        Route::resource('/trs_local_trs_log_activity_ews', 'Trs_log_activity_ewsController');
        Route::get('/trs_local_trs_log_activity_ews_list', 'Trs_log_activity_ewsController@getList');
    }
);
