<?php

use App\Http\V1\Auth\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/* Base API routes that don't need versioning like login and register go here. */

Route::get('/', function () {
    return 'Hello World!';
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
});
