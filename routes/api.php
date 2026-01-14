<?php

use Illuminate\Support\Facades\Route;

Route::middleware('client.credentials')->group(function() {
});


Route::get('/health', function () {
    return response()->json([
        'name' => config('app.name'),
        'status' => 'ok',
        'version' => '1.0.0'
    ], 200);
});