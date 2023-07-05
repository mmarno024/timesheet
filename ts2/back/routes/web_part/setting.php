<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setting\SettingController;

Route::group(['namespace' => 'Setting', 'middleware' => ['web', 'auth']], function () {
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
});
