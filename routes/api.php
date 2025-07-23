<?php

declare(strict_types=1);

use App\Http\Controllers\StoreTaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tasks')
    ->name('tasks.')
    ->group(function () {
        Route::post('/', StoreTaskController::class)->name('store');
    });
