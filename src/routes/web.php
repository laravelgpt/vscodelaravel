<?php

use Illuminate\Support\Facades\Route;
use LaravelGpt\Vscode\Http\Controllers\GitController;

Route::prefix('vscode-git')->group(function () {
    Route::get('/status', [GitController::class, 'status']);
    Route::post('/commit', [GitController::class, 'commit']);
    Route::post('/push', [GitController::class, 'push']);
    Route::post('/pull', [GitController::class, 'pull']);
    Route::get('/branches', [GitController::class, 'branches']);
});