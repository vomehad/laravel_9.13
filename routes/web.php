<?php

use App\Http\Controllers\AlgorithmController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('home');

Route::group(['prefix' => '/kinsman'], function() {
    Route::get('/create', [AuthController::class, 'signup'])->name('SignUp');
    Route::post('/create', [AuthController::class, 'create'])->name('Create');
    Route::match(['get', 'post'],'/login', [AuthController::class, 'login'])->name('Login');
    Route::post('/store', [AuthController::class, 'store'])->name('Store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('Logout');

    Route::get('/account', [UserController::class, 'account'])->middleware('auth')->name('Account');
});

Route::group(['prefix' => '/game'], function() {
    Route::get('/', [GameController::class, 'playGame'])->name('Game');
    Route::post('/create', [UserController::class, 'createRecord']);
});

Route::name('test.')->prefix('/test')->group(function() {
    Route::get('/', [CookieController::class, 'testingPage'])->name('main');

    Route::prefix('/cookie')->group(function() {
        Route::post('/add', [CookieController::class, 'addCookie'])->name('web-cookie');
        Route::get('/', [CookieController::class, 'getCookie']);
    });

    Route::prefix('/')->group(function() {
        Route::match(['get', 'post'],'/notes/search', [NoteController::class, 'search'])->name('notes.search');
        Route::resource('/notes', NoteController::class);
    });

    Route::resource('/categories', CategoryController::class);
});

Route::prefix('/')->group(function() {
    Route::match(['get', 'post'], '/articles/search',[ArticleController::class, 'search'])->name('articles.search');
    Route::resource('/articles', ArticleController::class);
});

Route::resource('tags', TagController::class);

Route::prefix('/')->group(function() {
    Route::resource('/users', UserController::class);
    Route::match(['get', 'post'], '/users.search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/roles/{id}', [UserController::class, 'roles'])->name('users.roles');
});

Route::prefix('algorithm')->group(function() {
    Route::get('/bubble', [AlgorithmController::class, 'index'])->name('sort');
});
