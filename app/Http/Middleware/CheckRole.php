<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Charger la relation role pour éviter les requêtes N+1
        $user = $request->user()->load('role');

        $roles = explode('|', $role);

        foreach ($roles as $r) {
            if ($user->hasRole($r)) {
                return $next($request);
            }
        }

        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}
