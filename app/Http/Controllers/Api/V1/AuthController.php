<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login(Request $request) {
        $credeniais =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credeniais)) {
            $user = $request->user();
            $token = $user->createToken('email-api-token')->plainTextToken;

            return response()->json([
                'status'=>'success',
                'token'=>$token,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Credenciais inválidas.'
        ], 401);
    }

}
