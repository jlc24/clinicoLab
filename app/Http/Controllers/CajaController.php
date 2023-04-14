<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\User;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = auth()->user();
        if ($usuario->rol == 'admin') {
            $cajas = Caja::all();
        } elseif ($usuario->rol == 'recepcion') {
            $cajas = Caja::where('user_id', '=', $usuario->id)->get();
        }
        
        return view('caja.index', [ 'cajas' => $cajas ]);
    }

    public function getCajaStatus()
    {
        $user = auth()->user();
        $caja = Caja::where('user_id', '=', $user->id)->whereDate('created_at', now()->format('Y-m-d'))->latest()->first();
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

        $usuario = auth()->user();
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

        $usuario = auth()->user();
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
