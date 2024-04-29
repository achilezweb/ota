<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('boards', BoardController::class)->middleware('auth');

// Routes for approving and marking as spam
Route::get('/boards/{job}/approve', [BoardController::class, 'approve'])->name('boards.approve');
Route::get('/boards/{job}/spam', [BoardController::class, 'spam'])->name('boards.spam');

Route::get('/job-list', [BoardController::class, 'list'])->name('boards.list');
