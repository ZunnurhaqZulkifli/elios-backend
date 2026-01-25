<?php

use App\Filament\Pages\LoginPage;
use App\Http\Controllers\BulkUploadController;
use Illuminate\Support\Facades\Route;

// Filament Routes
Route::get('/', function () {
    return redirect('/admin');
});

Route::get('login', LoginPage::class)->name('login');

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

// require __DIR__.'/auth.php';