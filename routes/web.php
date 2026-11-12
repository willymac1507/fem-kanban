<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [BoardController::class, 'index'])->name('dashboard');
    Route::post('boards/store', [BoardController::class, 'store'])->name('boards.store');
    Route::post('boards/tasks/store', [TaskController::class, 'store'])
        ->name('boards.tasks.store');
    Route::post('boards/tasks/{task}/update', [TaskController::class, 'update'])
        ->name('boards.tasks.update');
    Route::patch('subtasks/{subtask}', [SubtaskController::class, 'update'])
        ->name('subtasks.update');
});

require __DIR__.'/settings.php';
