<?php

namespace App\Http\Middleware;

use App\Models\Caja;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\Response;

class VerificarEstadoCaja
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $estadoCaja = Caja::obtenerEstadoCaja();
        if ($estadoCaja == 'no') {
            return redirect()->route('caja')->with('info', 'Primero debes Abrir Caja!');
        }elseif ($estadoCaja == 'nofecha') {
            return redirect()->route('caja')->with('info', 'Primero debes Cerrar la Caja!');
        }
        
        return $next($request);
    }
}
