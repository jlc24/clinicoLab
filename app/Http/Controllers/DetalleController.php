<?php

namespace App\Http\Controllers;

use App\Models\Detalle;
use Illuminate\Http\Request;

class DetalleController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Detalle $detalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detalle $detalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'max:20'
        ]);

        $detalle = Detalle::find($id);
        $detalle->tipo = $request->input('tipo');
        $detalle->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detalle $detalle)
    {
        //
    }
}
