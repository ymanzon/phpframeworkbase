<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Uso en rutas: ->middleware('permiso:inmuebles.crear').
// Basta con tener UNO de los permisos indicados. El rol administrador
// pasa siempre (ver User::tienePermiso).
class CheckPermiso
{
    public function handle(Request $request, Closure $next, string ...$permisos): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        foreach ($permisos as $permiso) {
            if ($user->tienePermiso($permiso)) {
                return $next($request);
            }
        }

        abort(403, 'No tienes permiso para realizar esta acción.');
    }
}
