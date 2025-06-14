<?php

use App\Http\Controllers\WeddingController;
use Illuminate\Support\Facades\Route;

// Public progress page
Route::get('/progress', [WeddingController::class, 'progress'])->name('wedding.progress');

// API endpoints for categories and priorities
Route::get('/api/categories', [WeddingController::class, 'getCategories'])->name('api.categories');
Route::get('/api/priorities', [WeddingController::class, 'getPriorities'])->name('api.priorities');

// Redirect home to dashboard for authenticated users, or progress for guests
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('wedding.progress');
})->name('home');

// Dashboard (protected routes)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [WeddingController::class, 'dashboard'])->name('dashboard');

    // Task management routes
    Route::post('/tasks', [WeddingController::class, 'createTask'])->name('tasks.create');
    Route::post('/tasks/{task}/toggle', [WeddingController::class, 'toggleTask'])->name('tasks.toggle');
    Route::patch('/tasks/{task}', [WeddingController::class, 'updateTask'])->name('tasks.update');
    Route::delete('/tasks/{task}', [WeddingController::class, 'deleteTask'])->name('tasks.delete');

    // Settings
    Route::patch('/wedding/settings', [WeddingController::class, 'updateSettings'])->name('wedding.settings.update');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
