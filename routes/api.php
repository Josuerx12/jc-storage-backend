<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::middleware('client.credentials')->group(function() {
    Route::post('upload', [FileController::class, 'upload'])->name('api.files.upload');
    
    Route::post('files/{file}/generate-signed-url', [FileController::class, 'generateUrl'])->name('api.files.generateSignedUrl');
    Route::delete('files/{file}', [FileController::class, 'delete'])->name('api.files.delete');
});


Route::get('/health', function () {
    return response()->json([
        'name' => config('app.name'),
        'status' => 'ok',
        'version' => '1.0.0'
    ], 200);
});