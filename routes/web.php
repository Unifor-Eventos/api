<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'app' => config('app.name')
    ];
});

Route::middleware([
    'auth:sanctum', 'throttle:api', 'verified'
])->group(static function (): void {
    Route::prefix('events')->as('events:')->group(
        base_path('routes/events.php'),
    );
});

Route::group(static function (): void {
    Route::prefix('auth')->as('auth:')->group(
        base_path('routes/auth.php'),
    );
});
