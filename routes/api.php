<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/me', [App\Http\Controllers\UserController::class, 'me']);
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\UserController::class, 'store']);
});