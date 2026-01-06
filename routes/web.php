<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/files/{id}', [App\Http\Controllers\FileController::class, 'download'])
    ->name('files.download')
    ->middleware('signed');
