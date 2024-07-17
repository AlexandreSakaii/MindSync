<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guard = $guards[0] ?? null;
        \Log::info('Guard utilizado: ', ['guard' => $guard]);

        if (Auth::guard($guard)->guest()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 401);
            }

            \Log::info('Redirecionando para login');
            return redirect()->guest(route('login'));
        }

        \Log::info('Usuário autenticado: ', ['user' => Auth::guard($guard)->user()]);

        return $next($request);
    }
}
