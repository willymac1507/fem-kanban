<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [BoardController::class, 'index'])->name('dashboard');
    Route::post('boards/store', [BoardController::class, 'store'])->name('boards.store');
    Route::post('boards/tasks/store', [TaskController::class, 'store'])
        ->name('boards.tasks.store');
});

require __DIR__.'/settings.php';
