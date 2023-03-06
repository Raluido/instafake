<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Log;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::middleware(['guest'])->group(function () {

        Route::get('/register', [RegisterController::class, 'show'])->name('register.show');

        Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
    });


    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [LoguinController::class, 'perform'])->name('logout');
    });
});
