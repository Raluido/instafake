<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\StoryController;
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
            Route::get('/liked/{dataId}', [ImageController::class, 'liked'])->name('image.getLike');
            Route::get('/story/getAll', [StoryController::class, 'getAll'])->name('story.getAll');
            Route::get('/story/{dataId}/{userId}', [StoryController::class, 'playAll'])->name('story.playAll');
            Route::get('/story/upload', [StoryController::class, 'uploadForm'])->name('story.uploadForm');
            Route::post('/story/store', [StoryController::class, 'store'])->name('story.store');
            Route::get('/story/publish/{fileName}', [StoryController::class, 'publishForm'])->name('story.publishForm');
            Route::post('/story/published', [StoryController::class, 'published'])->name('story.published');
            Route::get('/image/upload', [ImageController::class, 'uploadForm'])->name('image.uploadForm');
            Route::post('/image/store', [ImageController::class, 'store'])->name('image.store');
            Route::get('/image/publish/{fileName}', [ImageController::class, 'publishForm'])->name('images.publishForm');
            Route::post('/image/published', [ImageController::class, 'published'])->name('images.published');
            Route::get('/messages', [MessageController::class, 'showAll'])->name('messages.showAll');
            Route::get('/messages/{search}', [MessageController::class, 'search'])->name('messages.search');
            Route::get('/check', [MessageController::class, 'check'])->name('messages.check');
            Route::get('/message/{receiver}', [MessageController::class, 'show'])->name('messages.show');
            Route::post('/message/send', [MessageController::class, 'send'])->name('messages.send');
        });
    });
});
