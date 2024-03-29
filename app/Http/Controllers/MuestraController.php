<?php

namespace App\Http\Controllers;

use App\Models\Muestra;
use Illuminate\Http\Request;

class MuestraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $muestras = Muestra::all();
        return view('muestra.index', ['muestras' => $muestras]);
    }

    public function getMuestras()
    {
        $muestras = Muestra::orderByDesc('id')->get();
        return response()->json($muestras);
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
            'muestra_nombre' => 'required|max:255',
            'muestra_descripcion' => 'max:255',
        ]);

        Muestra::create([
            'nombre' => $request->input('muestra_nombre'),
            'descripcion' => $request->input('muestra_descripcion'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Muestra $muestra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $muestra = Muestra::find($id);
        return response()->json($muestra);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'muestra_nombre_update' => 'required|max:255',
            'muestra_descripcion_update' => 'max:255',
        ]);

        $muestra = Muestra::find($id);
        $muestra->nombre = $request->input('muestra_nombre_update');
        $muestra->descripcion = $request->input('muestra_descripcion_update');
        $muestra->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $muestra = Muestra::find($id);
        $muestra->delete();
    }
}
