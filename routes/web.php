<?php

use App\Http\Controllers\AlgorithmController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\KinController;
use App\Http\Controllers\KinsmanController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KinsmanController::class, 'index'])->name('home');

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale');

Route::prefix('/')->group(function() {
    Route::match(['get', 'post'],'/kinsmans/search', [KinsmanController::class, 'search'])->name('kinsmans.search');
    Route::resource('kinsmans', KinsmanController::class);
});

Route::prefix('/')->group(function() {
    Route::match(['get', 'post'],'/kinsmans2/search', [KinsmanController::class, 'search2'])->name('kinsmans2.search');
    Route::prefix('kinsmans2')->group(function() {
        Route::get('/', [KinsmanController::class, 'index_old'])->name('kinsmans2.index');
        Route::get('/{id}', [KinsmanController::class, 'show_old'])->name('kinsmans2.show');
    });
});

Route::prefix('/')->group(function() {
    Route::match(['get', 'post'],'/kins/search', [KinController::class, 'search'])->name('kins.search');
    Route::resource('kins', KinController::class);
});

Route::group(['prefix' => '/game'], function() {
    Route::get('/', [GameController::class, 'playGame'])->name('Game');
    Route::post('/create', [GameController::class, 'createRecord']);
});

Route::name('test.')->prefix('/test')->group(function() {
    Route::get('/', [CookieController::class, 'testingPage'])->name('main');

    Route::resource('cookie', CookieController::class)->only(['index', 'store']);

    Route::prefix('/')->group(function() {
        Route::match(['get', 'post'],'/notes/search', [NoteController::class, 'search'])->name('notes.search');
        Route::resource('/notes', NoteController::class);
    });
});

Route::prefix('/')->group(function() {
    Route::match(['get', 'post'], '/articles/search',[ArticleController::class, 'search'])->name('articles.search');
    Route::resource('/articles', ArticleController::class);
});

Route::prefix('algorithm')->group(function() {
    Route::get('/bubble', [AlgorithmController::class, 'index'])->name('sort');
});
