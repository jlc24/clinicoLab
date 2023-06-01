<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Obtén el rol del usuario actual
            $userRole = Auth::user()->rol;

            if (is_array($roles)) {
                $requiredRoles = $roles;
            } else {
                $requiredRoles = explode('|', $roles);
            }

            // Itera a través de los roles requeridos
            foreach ($requiredRoles as $role) {
                // Si el usuario tiene el rol necesario, permite el acceso
                if ($userRole == $role) {
                    return $next($request);
                }
            }
        }

        // Si el usuario no tiene permisos suficientes, redirige a una página de error
        return redirect('error')->with('message', 'No tienes permisos para acceder a esta página.');
    }
}
