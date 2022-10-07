<?php

use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\KinsmanController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function() {
    Route::post('/word', [ExamController::class, 'processWord'])->name('word');
    Route::post('/text', [ExamController::class, 'switchDates'])->name('text');

    Route::resource('kinsmans', KinsmanController::class);
    Route::post('photo', [KinsmanController::class, 'storePhoto']);
    Route::get('yandex/login', [KinsmanController::class, 'yandexLogin']);
});
