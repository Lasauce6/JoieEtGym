<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['throttle:global'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');
    Route::get('/news', [PostController::class, 'getPosts'])->name("news");
    Route::get('/news/{category}', [PostController::class, 'category'])->name('news.category');
    Route::get('/news/{category}/{slug}', [PostController::class, 'post'])->name('news.post');
    Route::get('/planning', [MainController::class, 'planning'])->name('planning');
    Route::get('/load-planning', [MainController::class, 'loadPlanning'])->name('loadPlanning');
    Route::get('/inscription', [MainController::class, 'inscription'])->name('inscription');
    Route::get('/register', [MainController::class, 'register'])->name('register');
    Route::get('/login', [MainController::class, 'login'])->name('login');
    Route::view('/legals', 'legals')->name('legals');
    Route::view('/404', 'errors.404')->name('404');
});

Route::middleware(['throttle:login'])->group(function () {
    Route::post('/login', [MainController::class, 'postLogin']);
});

Route::middleware(['throttle:global', 'auth'])->group(function () {
    Route::get('/profile', [MainController::class, 'profile'])->name('profile');
    Route::get('/logout', [MainController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'admin', 'middleware' => ['throttle:global', 'admin']], function () {
    Voyager::routes();
});
