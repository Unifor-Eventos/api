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

require __DIR__ . '/auth.php';
