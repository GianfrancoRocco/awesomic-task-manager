<?php

declare(strict_types=1);

use App\Http\Controllers\Api\{
    DeleteTaskController,
    GetTaskController,
    ListTaskController,
    StoreTaskController,
    UpdateTaskController
};
use Illuminate\Support\Facades\Route;

Route::prefix('/tasks')
    ->name('tasks.')
    ->group(function () {
        Route::get('/', ListTaskController::class)->name('index');

        Route::post('/', StoreTaskController::class)->name('store');

        Route::get('/{task}', GetTaskController::class)->name('show');

        Route::put('/{task}', UpdateTaskController::class)->name('update');

        Route::delete('/{task}', DeleteTaskController::class)->name('delete');
    });
