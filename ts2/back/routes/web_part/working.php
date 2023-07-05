<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Working\WorkingController;

Route::group(['namespace' => 'Working', 'middleware' => ['web', 'auth']], function () {
    Route::get('working', [WorkingController::class, 'index'])->name('working');
    Route::get('working_installation', [WorkingController::class, 'getInstallation'])->name('working_installation');
    Route::get('working_service', [WorkingController::class, 'getService'])->name('working_service');
    Route::get('working_survey', [WorkingController::class, 'getSurvey'])->name('working_survey');
    Route::get('working_etc', [WorkingController::class, 'getEtc'])->name('working_etc');
});
