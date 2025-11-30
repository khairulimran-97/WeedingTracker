<?php

use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;

// Groom's custom domain (khairulimran.me)
Route::domain('khairulimran.me')->group(function () {
    Route::get('/', function () {return view('invitation-lelaki');})->name('wedding.invitation.lelaki.domain');
});

// Main wedding site routes
//Route::get('/persiapan', [WeddingController::class, 'progress'])->name('wedding.progress');
Route::post('/tasks/{task}/toggle', [WeddingController::class, 'toggleTask'])->name('tasks.toggle');
Route::get('/taaruf', function () {return view('taaruf');})->name('wedding.taaruf');
Route::get('/', function () {return view('invitation');})->name('wedding.invitation');
Route::get('/lelaki', function () {return view('invitation-lelaki');})->name('wedding.invitation.lelaki');
//Route::get('/tunang', function () {return view('tunang');})->name('wedding.tunang');
Route::redirect('/taaruf.html', '/taaruf');


Route::get('/api/categories', [WeddingController::class, 'getCategories'])->name('api.categories');
Route::get('/api/priorities', [WeddingController::class, 'getPriorities'])->name('api.priorities');

// Wishes routes
Route::get('/api/wishes', [WishController::class, 'index'])->name('wishes.index');
Route::post('/api/wishes', [WishController::class, 'store'])->name('wishes.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [WeddingController::class, 'dashboard'])->name('dashboard');
    Route::post('/tasks', [WeddingController::class, 'createTask'])->name('tasks.create');
    Route::patch('/tasks/{task}', [WeddingController::class, 'updateTask'])->name('tasks.update');
    Route::delete('/tasks/{task}', [WeddingController::class, 'deleteTask'])->name('tasks.delete');
    Route::patch('/wedding/settings', [WeddingController::class, 'updateSettings'])->name('wedding.settings.update');
});

require __DIR__.'/auth.php';
require __DIR__.'/settings.php';
