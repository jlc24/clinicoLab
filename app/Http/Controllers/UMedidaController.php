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

    public function getUmedidas()
    {
        $medidas = UMedida::orderBy('categoria')->orderBy('nombre')->get();
        return response()->json($medidas);
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
            'medida_categoria' => 'required|max:100',
            'medida_nombre' => 'required|max:100',
            'medida_unidad' => 'required|max:50'
        ]);

        UMedida::create([
            'categoria' => $request->input('medida_categoria'),
            'nombre' => $request->input('medida_nombre'),
            'unidad' => $request->input('medida_unidad')
        ]);

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
    public function edit($id)
    {
        $medida = UMedida::find($id);
        return response()->json($medida);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'medida_categoria_update' => 'required|max:100',
            'medida_nombre_update' => 'required|max:100',
            'medida_unidad_update' => 'required|max:50'
        ]);

        $medida = UMedida::find($id);
        $medida->categoria = $request->input('medida_categoria_update');
        $medida->nombre = $request->input('medida_nombre_update');
        $medida->unidad = $request->input('medida_unidad_update');
        $medida->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medida = UMedida::find($id);
        $medida->delete();
    }
}
