<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'fac_estado' => 'required|integer',
        ]);

        $data = $request->input('fac_estado');
        Factura::create([
            'fac_estado' => $data,
        ]);
        $factura = Factura::latest()->first();
        return response()->json($factura);
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cli_id' => 'integer',
            'med_id' => 'integer',
            'emp_id' => 'integer',
            'fac_total' => 'decimal:2',
            'fac_estado' => 'required|integer',
            'fac_pago' => 'max:50',
            'fac_descuento' => 'integer',
            'fac_observacion'=> 'max:255',
            'fac_referencia' => 'max:255',
            'fac_importe' => 'decimal:2',
            'fac_cambio' => 'decimal:2',
        ]);
        $user_id = auth()->user()->id;
        $config_id = Configuration::latest()->first();
        
        $factura = Factura::find($id);
        $factura->update([
            'cli_id' => $request->input('cli_id'),
            'med_id' => $request->input('med_id'),
            'emp_id' => $request->input('emp_id'),
            'user_id' => $user_id,
            'config_id' => $config_id->id,
            'fac_total' => $request->input('fac_total'),
            'fac_estado' => '1',
            'fac_pago' => $request->input('fac_pago'),
            'fac_descuento' => $request->input('fac_descuento'),
            'fac_observacion' => $request->input('fac_observacion'),
            'fac_referencia' => $request->input('fac_referencia'),
            'fac_importe' => $request->input('fac_importe'),
            'fac_cambio' => $request->input('fac_cambio')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
