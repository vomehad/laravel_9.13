<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function() {
    Route::post('/word', [UserController::class, 'processWord'])->name('word');
    Route::post('/text', [UserController::class, 'switchDates'])->name('text');
});
