<?php

use App\Http\Controllers\Api\V1\EmailController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);



Route::get('/emails', [EmailController::class, 'index']);
Route::get('/emails/{user_name}', [EmailController::class, 'show']);

Route::middleware('check.api.token')->group(function () {
    Route::post('/sendmail/email/send', [EmailController::class, 'sendEmail'])
        ->name('api.sendmail');
}); 

