<?php
Route::group(
    ['namespace' => 'Trs\Local', 'middleware' => ['web', 'auth']],
    function () {
        Route::resource('/trs_local_trs_timesheet', 'Trs_timesheetController');
        Route::get('/trs_local_trs_timesheet_list', 'Trs_timesheetController@getList');
        Route::get('/trs_local_trs_timesheet_lookup', 'Trs_timesheetController@getLookup');
    }
);
