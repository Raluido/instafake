<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RedirectIfAuthenticated;
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

    Route::middleware(['guest'])->group(function () {
        Route::get('/', [LoginController::class, 'show'])->name('login.show');
        Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
        Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    });


    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
        Route::get('/{nick?}', [HomeController::class, 'index'])->name('home');
        Route::group(['prefix' => '{nick}'], function () {
            Route::get('/messages', [HomeController::class, 'showMessages'])->name('user.messages');
            Route::get('/messages/{id?}', [HomeController::class, 'showMessage'])->name('user.showMessage');
        });
    });
});
