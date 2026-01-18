<?php

use App\Http\Controllers\BucketController;
use App\Http\Controllers\CredencialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/docs', function () {
    return view('docs');
});

Route::get('/files/{file}', [FileController::class, 'download'])
->name('files.download')
->missing(fn () => abort(404, 'Arquivo não encontrado'))
->middleware('signed');

Route::get('/download/{file}', [FileController::class, 'publicDownload'])
->missing(fn () => abort(404, 'Arquivo não encontrado'))
->name('files.public.download');

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
    
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    Route::post('/dashboard/credentials', [CredencialController::class, 'store'])->name('dashboard.credentials.store');
    Route::delete('/dashboard/credentials/{credential}', [CredencialController::class, 'destroy'])->name('credentials.destroy');

    Route::get('/dashboard/credentials', [CredencialController::class, 'index'])->name('dashboard.credentials');
    Route::get('/dashboard/credentials/create', [CredencialController::class, 'create'])->name('dashboard.credentials.create');
    Route::get('/dashboard/credentials/{credential}', [CredencialController::class, 'show'])->name('dashboard.credentials.show');
    Route::get('/dashboard/credentials/{credential}/delete', [CredencialController::class, 'delete'])->name('dashboard.credentials.delete');

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

    Route::get('/dashboard/buckets/{bucket}/files', [BucketController::class, 'showFiles'])
    ->name('dashboard.buckets.files')
    ->missing(fn () => redirect()
    ->route('dashboard.buckets')
    ->with('error', 'Bucket não encontrado.'));

    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
    Route::get('/dashboard/buckets/{bucket}/files/{file}/delete', [FileController::class, 'deleteView'])
    ->name('dashboard.buckets.files.delete')
    ->missing(fn () => redirect()
    ->route('dashboard.buckets.files', $bucket)
    ->with('error', 'Arquivo não encontrado.'));
});