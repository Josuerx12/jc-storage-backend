<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs', function () {
    return view('docs');
});

// Auth routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'webLogin']);
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'webRegister'])->name('register.submit');
});

// Protected routes (auth only)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/files/{id}', [App\Http\Controllers\FileController::class, 'download'])
    ->name('files.download')
    ->middleware('signed');
