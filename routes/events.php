<?php

use App\Http\Controllers\Event\EventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/', EventController::class);
