<?php

namespace App\Http\Controllers;

use App\Models\UMedida;
use Illuminate\Http\Request;

class UMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('umedida.index', [
            'medidas' => UMedida::all()
        ]);
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
            'medida_unidad' => 'required|max:50'
        ]);

        UMedida::create([
            'unidad' => $request->input('medida_unidad')
        ]);

        return redirect()->route('umedida')->with('success', 'El registro se ha creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(UMedida $uMedida)
    {
        //
    }
    
    public function getUmedUnidad($id)
    {
        $unidad = UMedida::find($id)->unidad;
        return response()->json($unidad);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UMedida $uMedida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'medida_unidad_update' => 'required|max:50'
        ]);

        $medida = UMedida::find($id);
        $medida->unidad = $request->input('medida_unidad_update');
        $medida->save();

        return redirect()->route('umedida')->with('success', 'El registro se ha modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medida = UMedida::find($id);
        $medida->delete();

        return redirect()->route('umedida')->with('success', 'El registro se ha eliminado con éxito');
    }
}
