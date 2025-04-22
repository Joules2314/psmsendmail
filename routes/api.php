<?php

use App\Http\Controllers\Api\V1\EmailController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);



Route::get('/emails', [EmailController::class, 'index']);
Route::get('/emails/{user_name}', [EmailController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/email/send', [EmailController::class, 'store']);
});

