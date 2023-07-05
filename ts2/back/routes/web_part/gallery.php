<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gallery\GalleryController;

Route::group(['namespace' => 'Gallery', 'middleware' => ['web', 'auth']], function () {
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');
});
