<?php

namespace App\Http\Middleware;

use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization') ?? $request->input('remember_token');

        if (! $token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }

        $usuario = Usuario::where('remember_token', $token)->first();

        if (! $usuario) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        Auth::login($usuario);

        return $next($request);
    }
}
