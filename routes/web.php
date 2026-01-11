<?php

use App\Http\Controllers\BucketController;
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
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/credentials', function () {
        return view('dashboard.credentials');
    })->name('dashboard.credentials');

    Route::post('buckets', [BucketController::class, 'store'])->name('buckets.store');
    Route::delete('buckets/{bucket}', [BucketController::class, 'destroy'])->name('buckets.destroy');

    Route::get('/dashboard/buckets',[BucketController::class, 'showIndex'])->name('dashboard.buckets');
    Route::get('/dashboard/buckets/create',[BucketController::class, 'create'])->name('dashboard.buckets.create');
    Route::get('/dashboard/buckets/{bucket}', [BucketController::class, 'show'])
    ->name('dashboard.buckets.show')
    ->missing(fn () => redirect()
    ->route('dashboard.buckets')
    ->with('error', 'Bucket não encontrado.'));
    
    Route::get('/dashboard/buckets/{bucket}/delete', [BucketController::class, 'delete'])
    ->name('dashboard.buckets.delete')
    ->missing(fn () => redirect()
    ->route('dashboard.buckets')
    ->with('error', 'Bucket não encontrado.'));
});

Route::get('/files/{id}', [App\Http\Controllers\FileController::class, 'download'])
    ->name('files.download')
    ->middleware('signed');
