<?php

use App\Http\Controllers\Event\EnrollController;
use App\Http\Controllers\Event\EventController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{id}', [EventController::class, 'show']);
    Route::post('/events', [EventController::class, 'store']);
    Route::patch('/events/{id}', [EventController::class, 'update']);
    Route::post('/events/{id}/banner', [EventController::class, 'updateBanner']);
    Route::delete('/events/{id}', [EventController::class, 'update']);
    Route::get('/events/{id}/enrolls', [EnrollController::class, 'index']);
    Route::post('/events/{id}/enrolls', [EnrollController::class, 'store']);
    Route::post('/events/{eventId}/enrolls/accept', [EnrollController::class, 'accept']);
    Route::post('/events/{eventId}/enrolls/reject', [EnrollController::class, 'reject']);
});
