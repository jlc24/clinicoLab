<?php

namespace App\Http\Controllers;

use App\Models\Metodologia;
use Illuminate\Http\Request;

class MetodologiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('metodologia.index', [
            'metodos' => Metodologia::all()
        ]);
    }

    public function getMetodologias()
    {
        $metodologias = Metodologia::orderByDesc('id')->get();
        return response()->json($metodologias);
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
            'metodo_nombre' => 'required|max:100',
            'metodo_descripcion' => 'max:255'
        ]);

        Metodologia::create([
            'nombre' => $request->input('metodo_nombre'),
            'descripcion' => $request->input('metodo_descripcion'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Metodologia $metodologia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $metodologia = Metodologia::find($id);
        return response()->json($metodologia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'metodo_nombre_update' => 'required|max:100',
            'metodo_descripcion_update' => 'max:255'
        ]);

        $metodo = Metodologia::find($id);
        $metodo->nombre = $request->input('metodo_nombre_update');
        $metodo->descripcion = $request->input('metodo_descripcion_update');
        $metodo->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $metodo = Metodologia::find($id);
        $metodo->delete();
    }
}
