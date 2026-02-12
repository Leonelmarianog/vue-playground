<?php

use Illuminate\Support\Facades\Route;

/* Base API routes that don't need versioning like login and register go here. */

Route::get('/', function () {
    return 'Hello World!';
});
