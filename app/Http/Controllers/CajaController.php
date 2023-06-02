<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Factura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();
        if ($usuario->rol == 'admin') {
            $cajas = Caja::orderByDesc('created_at')->get();
        } elseif ($usuario->rol == 'usuario') {
            $cajas = Caja::where('user_id', '=', $usuario->id)->orderBy('created_at')->get();
        }
        $totalFactura = Factura::whereDate('updated_at', Carbon::today())->sum('fac_total');
        
        return view('caja.index', [ 
            'cajas' => $cajas,
            'totalFacturas' => $totalFactura
        ]);
    }

    public function getCajaStatus()
    {
        $user = Auth::user();
        $caja = Caja::where('user_id', '=', $user->id)->latest()->first();
        return response()->json($caja);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caja_monto_apertura' => 'required',
            'caja_estado' => 'required'
        ]);

        $usuario = Auth::user();
        Caja::create([
            'user_id' => $usuario->id,
            'caja_monto_inicial' => $request->input('caja_monto_apertura'),
            'caja_estado' => $request->input('caja_estado')
        ]);

        return redirect()->route('caja')->with('success', 'El registro se ha creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Caja $caja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'caja_monto_cierre' => 'required',
            'caja_estado' => 'required',
            'caja_cambio' => 'required',
        ]);

        $usuario = Auth::user();
        $caja = Caja::where('id', '=', $id)->first();
        $caja->update([
            'user_id' => $usuario->id,
            'caja_monto_final' => $request->input('caja_monto_cierre'),
            'caja_estado' => $request->input('caja_estado'),
            'caja_cambio' => $request->input('caja_cambio')
        ]);

        return redirect()->route('caja')->with('success', 'Se cerró la caja con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $caja)
    {
        //
    }
}
