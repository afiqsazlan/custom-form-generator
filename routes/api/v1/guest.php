<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Guest\LoginController;
use App\Http\Controllers\Api\V1\Guest\RegisterController;

Route::middleware('guest')->group(function () {
    Route::post('login', LoginController::class);
    Route::post('register', RegisterController::class);
});
