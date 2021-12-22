<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoreaController;
use App\Http\Controllers\KorwilController;
use App\Http\Controllers\ProductController;
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
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    });
    Route::group(['middleware' => ['cek_login:korea']], function () {
        Route::get('/korea', [KoreaController::class, 'index'])->name('korea');
        Route::get('/korea/read', [KoreaController::class, 'read']);
        Route::get('/korea/create', [KoreaController::class, 'create']);
        Route::get('/korea/store', [KoreaController::class, 'store']);
        Route::get('/korea/show/{id}', [KoreaController::class, 'show']);
        Route::get('/korea/update/{id}', [KoreaController::class, 'update']);
        Route::get('/korea/destroy/{id}', [KoreaController::class, 'destroy']);
    });
    Route::group(['middleware' => ['cek_login:korwil']], function () {
        Route::get('/korwil', [KorwilController::class, 'index'])->name('korwil');
        Route::get('/korwil/read', [KorwilController::class, 'read']);
        Route::get('/korwil/create', [KorwilController::class, 'create']);
        Route::get('/korwil/store', [KorwilController::class, 'store']);
        Route::get('/korwil/show/{id}', [KorwilController::class, 'show']);
        Route::get('/korwil/update/{id}', [KorwilController::class, 'update']);
        Route::get('/korwil/destroy/{id}', [KorwilController::class, 'destroy']);
    });
});
Auth::routes();

