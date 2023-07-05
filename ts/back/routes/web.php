<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\InstalasiController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DataclientController;

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth'], function () {
    Route::get('daftar_timesheet', [TimesheetController::class, 'daftarTimesheet'])->name('daftar_timesheet');
    Route::get('input_timesheet', [TimesheetController::class, 'inputTimesheet'])->name('input_timesheet');
    Route::post('insert_timesheet', [TimesheetController::class, 'insertTimesheet'])->name('insert_timesheet');
    Route::get('edit_timesheet/{id}', [TimesheetController::class, 'editTimesheet'])->name('edit_timesheet');
    Route::post('update_timesheet', [TimesheetController::class, 'updateTimesheet'])->name('update_timesheet');
    Route::get('delete_timesheet/{id}', [TimesheetController::class, 'deleteTimesheet']);
    Route::get('detail_timesheet/{id}', [TimesheetController::class, 'detailTimesheet'])->name('detail_timesheet');

    Route::get('daftar_instalasi', [InstalasiController::class, 'daftarInstalasi'])->name('daftar_instalasi');
    Route::get('input_instalasi', [InstalasiController::class, 'showFormInputInstalasi'])->name('input_instalasi');
    Route::post('input_instalasi', [InstalasiController::class, 'inputInstalasi']);
    Route::get('edit_instalasi/{id}', [InstalasiController::class, 'showFormEditInstalasi'])->name('edit_instalasi');
    Route::post('update_instalasi', [InstalasiController::class, 'updateInstalasi'])->name('update_instalasi');
    Route::get('delete_instalasi/{id}', [InstalasiController::class, 'deleteinstalasi']);

    Route::get('daftar_service', [ServiceController::class, 'daftarservice'])->name('daftar_service');
    Route::get('input_service', [ServiceController::class, 'showFormInputservice'])->name('input_service');
    Route::post('input_service', [ServiceController::class, 'inputService']);
    Route::get('edit_service/{id}', [ServiceController::class, 'showFormEditService'])->name('edit_service');
    Route::post('update_service', [ServiceController::class, 'updateService'])->name('update_service');
    Route::get('delete_service/{id}', [ServiceController::class, 'deleteService']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('download1', [HomeController::class, 'getDownload1'])->name('download1');
    Route::get('download2', [HomeController::class, 'getDownload2'])->name('download2');
    Route::get('download3', [HomeController::class, 'getDownload3'])->name('download3');
    Route::get('download4', [HomeController::class, 'getDownload4'])->name('download4');
    
    // Route::get('report', [DataController::class, 'index'])->name('report');
    // Route::get('detail/{id}', [DataController::class, 'detail']);
});
Route::get('data', [DataclientController::class, 'viewData']);
