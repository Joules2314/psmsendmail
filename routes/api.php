<?php

use App\Http\Controllers\Api\V1\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('check.api.key')->group(function () {
    Route::post('/email/send', [EmailController::class, 'store']);
    Route::get('/emails', [EmailController::class, 'index']);
    Route::get('/emails/{user_name}', [EmailController::class, 'show']);
});

