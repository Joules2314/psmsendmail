<?php

use App\Http\Controllers\Api\V1\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
    //return $request->user();
//})->middleware('auth:sanctum');

Route::get('/emails', [EmailController::class, 'index']);
Route::get('/emails/{user_name}', [EmailController::class, 'show']);
Route::post('/email/send', [EmailController::class, 'store']);
