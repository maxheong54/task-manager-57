<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('profile', ProfileController::class)
        ->only(['edit', 'update', 'destroy']);
});

Route::resource('task_statuses', TaskStatusController::class)
        ->except(['show']);

require __DIR__.'/auth.php';
