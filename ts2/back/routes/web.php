<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
// Route::get('/coba', [App\Http\Controllers\HomeController::class, 'getCoba'])->name('coba');
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'getHome'])->name('home');

use App\Http\Controllers\HomeController;

Auth::routes();
foreach (File::allFiles(__DIR__ . '/web_part') as $route) {
	require_once $route->getPathname();
}

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'getHome'])->name('home');
    Route::get('home', [HomeController::class, 'getHome'])->name('home');
});
