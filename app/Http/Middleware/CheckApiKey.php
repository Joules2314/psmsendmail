<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $headerName = config('api-keys.header', 'X-API-KEY');
        $provided   = $request->header($headerName);
        $validKeys  = (array) config('api-keys.keys', []);

        if (empty($provided) || empty($validKeys)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Comparação em tempo constante contra todas as chaves válidas
        foreach ($validKeys as $valid) {
            if (hash_equals($valid, $provided)) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
