<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\ProfileController;

Route::group(['namespace' => 'Profile', 'middleware' => ['web', 'auth']], function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
});
