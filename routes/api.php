<?php

declare(strict_types=1);

use App\Http\Controllers\DeleteTaskController;
use App\Http\Controllers\StoreTaskController;
use App\Http\Controllers\UpdateTaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tasks')
    ->name('tasks.')
    ->group(function () {
        Route::post('/', StoreTaskController::class)->name('store');

        Route::put('/{task}', UpdateTaskController::class)->name('update');

        Route::delete('/{task}', DeleteTaskController::class)->name('delete');
    });
