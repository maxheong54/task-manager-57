<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
    ->only(['index']);
Route::resource('task_statuses', TaskStatusController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

Route::resource('tasks', TaskController::class)
    ->except(['index', 'show'])
    ->middleware('auth');
Route::resource('tasks', TaskController::class)
    ->only(['index', 'show']);

Route::resource('labels', LabelController::class)
    ->only(['index']);
Route::resource('labels', LabelController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

require __DIR__.'/auth.php';
