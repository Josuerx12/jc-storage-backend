<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    // User
    Route::get('/me', [App\Http\Controllers\UserController::class, 'me']);

    // Buckets
    Route::post('/buckets', [App\Http\Controllers\BucketController::class, 'store']);
    Route::get('/buckets', [App\Http\Controllers\BucketController::class, 'index']);
    Route::get('/buckets/{bucket}', [App\Http\Controllers\BucketController::class, 'show']);
    Route::delete('/buckets/{bucket}', [App\Http\Controllers\BucketController::class, 'destroy']);

    // Files
    Route::post('/files', [App\Http\Controllers\FileController::class, 'upload']);
    Route::get('/files/{file}/generate-url', [App\Http\Controllers\FileController::class, 'generateUrl']);
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\UserController::class, 'store']);
});

Route::get('/health', function () {
    return response()->json([
        'name' => config('app.name'),
        'status' => 'ok',
        'version' => '1.0.0'
    ], 200);
});