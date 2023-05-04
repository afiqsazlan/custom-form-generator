<?php

use App\Http\Controllers\Api\V1\Admin\FormController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/forms/create', [FormController::class,'create']);
});
