<?php

use Illuminate\Support\Facades\Route;

// Filament Routes
Route::get('/', function () {
    return redirect('/admin');
});

// Inertia Routes
require __DIR__.'/inertia.php';
// require __DIR__.'/auth.php';