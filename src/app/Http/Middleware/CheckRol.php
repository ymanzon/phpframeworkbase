<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Uso en rutas: ->middleware('rol:administrador') o 'rol:administrador,agente'.
// Basta con tener UNO de los roles indicados.
class CheckRol
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user || !$user->tieneRol(...$roles)) {
            abort(403, 'No tienes el rol necesario para ver esta página.');
        }

        return $next($request);
    }
}
