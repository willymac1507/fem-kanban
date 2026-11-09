<?php

use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [BoardController::class, 'index'])->name('dashboard');
    Route::post('dashboard', [BoardController::class, 'store'])->name('boards.store');
});

require __DIR__.'/settings.php';
