<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'app' => config('app.name')
    ];
});

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('events')
    ->group(static function (): void {
        Route::as('event.')->group(
            base_path('routes/events.php'),
        );
    });

Route::prefix('auth')
    ->group(static function (): void {
        Route::as('auth.')->group(
            base_path('routes/auth.php'),
        );
    });
