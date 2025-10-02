<?php

use App\Http\Controllers\Api\UsersApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes for Users
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::apiResource('users', UsersApiController::class);
    // Route::get('users/search', [UsersApiController::class, 'search'])->name('api.users.search');
});
