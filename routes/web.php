<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoreaController;
use App\Http\Controllers\KorwilController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::get('/admin', [ReportController::class, 'index'])->name('admin');
    });
    // Route::group(['middleware' => ['cek_login:korea']], function () {
        Route::get('/report', [ReportController::class, 'index'])->name('report');
        Route::get('/report/read', [ReportController::class, 'read']);
        Route::get('/report/create', [ReportController::class, 'create']);
        Route::get('/report/store', [ReportController::class, 'store']);
        Route::post('/report/store/image', [ReportController::class, 'store_image'])->name('store');
        Route::put('/report/put/image', [ReportController::class, 'update_image'])->name('put');
        Route::get('/report/show/{id}', [ReportController::class, 'show']);
        Route::get('/report/update/{id}', [ReportController::class, 'update']);
        Route::get('/report/destroy/{id}', [ReportController::class, 'destroy']);
    // });
    // Route::group(['middleware' => ['cek_login:korwil']], function () {
    //     Route::get('/korwil', [KoreaController::class, 'index'])->name('korwil');
    //     Route::get('/korwil/read', [KoreaController::class, 'read']);
    //     Route::get('/korwil/create', [KoreaController::class, 'create']);
    //     Route::get('/korwil/store', [KoreaController::class, 'store']);
    //     Route::get('/korwil/show/{id}', [KoreaController::class, 'show']);
    //     Route::get('/korwil/update/{id}', [KoreaController::class, 'update']);
    //     Route::get('/korwil/destroy/{id}', [KoreaController::class, 'destroy']);
    // });
});
Auth::routes();

