<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Image;
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

            Route::group(['prefix' => 'user'], function () {
                Route::get('/myProfile', [UserController::class, 'showProfile'])->name('user.myProfile');
                Route::get('/search', [UserController::class, 'searchForm'])->name('user.searchForm');
                Route::get('/search/{inputSearch}', [UserController::class, 'search'])->name('user.search');
                Route::get('/profile/{userId}', [UserController::class, 'showProfiles'])->name('user.profile');
                Route::get('/checkFollows/{userId}', [UserController::class, 'check'])->name('user.checkFollows');
                Route::post('/follow', [UserController::class, 'follow'])->name('user.follow');
                Route::delete('/unfollow/{userId}', [UserController::class, 'remove'])->name('user.unfollow');
                Route::get('/show/{filename}/{id?}', [UserController::class, 'getImage'])->name('user.avatar');
            });
            Route::group(['prefix' => 'stories'], function () {
                Route::get('/getAll', [StoryController::class, 'getAll'])->name('stories.getAll');
                Route::get('/{dataId}/{userId}', [StoryController::class, 'playAll'])->name('stories.playAll');
                Route::get('/upload', [StoryController::class, 'uploadForm'])->name('stories.uploadForm');
                Route::post('/store', [StoryController::class, 'store'])->name('stories.store');
                Route::get('/show/{filename}', [StoryController::class, 'getStory'])->name('stories.show');
            });
            Route::group(['prefix' => 'images'], function () {
                Route::get('/liked/{dataId}', [ImageController::class, 'liked'])->name('images.getLike');
                Route::get('/upload', [ImageController::class, 'uploadForm'])->name('images.uploadForm');
                Route::post('/store', [ImageController::class, 'store'])->name('images.store');
                Route::get('/publish/{fileName}', [ImageController::class, 'publishForm'])->name('images.publishForm');
                Route::post('/published', [ImageController::class, 'published'])->name('images.published');
                Route::get('/show/{filename}', [ImageController::class, 'getImage'])->name('images.show');
            });
            Route::group(['prefix' => 'messages'], function () {
                Route::get('', [MessageController::class, 'showAll'])->name('messages.showAll');
                Route::get('/check', [MessageController::class, 'check'])->name('messages.check');
                Route::get('/{search}', [MessageController::class, 'search'])->name('messages.search');
                Route::get('/show/{receiver}', [MessageController::class, 'show'])->name('messages.show');
                Route::post('/send', [MessageController::class, 'send'])->name('messages.send');
            });
            Route::group(['prefix' => 'comments'], function () {
                Route::get('/liked/{dataId}', [CommentController::class, 'liked'])->name('comments.getLike');
                Route::get('/showAll/{imageId}', [CommentController::class, 'showAll'])->name('comments.showAll');
                Route::post('/store', [CommentController::class, 'store'])->name('comments.store');
            });
        });
    });
});
