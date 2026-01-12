<?php

use App\Http\Controllers\BulkUploadController;
use Illuminate\Support\Facades\Route;

// Filament Routes
Route::get('/', function () {
    return redirect('/admin');
});

Route::group(['prefix' => '/bulk-uploads'], function () {

    // download the template
    Route::get('download/{type}', [BulkUploadController::class, 'download'])
        ->name('bulk-uploads.excel');

    // view the template
    Route::get('view/{type}', [BulkUploadController::class, 'view'])
        ->name('bulk-uploads.view');

    // upload the file
    Route::post('upload/{type}', [BulkUploadController::class, 'upload'])
        ->name('bulk-uploads.upload');
});

// Inertia Routes
require __DIR__ . '/inertia.php';
// require __DIR__.'/auth.php';