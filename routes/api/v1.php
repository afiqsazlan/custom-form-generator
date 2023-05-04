<?php

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::post('login', LoginController::class);
    Route::post('register', RegisterController::class);
});

Route::middleware('auth:sanctum')->group(function () {

});
