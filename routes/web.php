<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'app' => config('app.name')
    ];
});

require __DIR__ . '/events.php';
require __DIR__ . '/auth.php';
