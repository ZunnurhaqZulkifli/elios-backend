<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Users
    Route::resource('users', UsersController::class);
    
    // TanStack Query Example
    Route::get('/users/tanstack-example', function () {
        return Inertia::render('users/tanstack-example');
    })->name('users.tanstack-example');

    // Projects
    Route::resource('projects', ProjectsController::class);

    // Tasks
    Route::resource('tasks', TasksController::class);

    // Settings
    Route::resource('settings', SettingsController::class)->only(['index', 'update']);
});

require __DIR__.'/auth.php';
