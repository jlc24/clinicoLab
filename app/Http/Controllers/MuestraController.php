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
            'muestra_nombre' => 'required|max:20',
            'muestra_descripcion' => 'required|max:255',
        ]);

        Muestra::create([
            'nombre' => $request->input('muestra_nombre'),
            'descripcion' => $request->input('muestra_descripcion'),
        ]);

        return redirect()->route('muestra')->with('success', 'El registro se ha creado con éxito');
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
    public function edit(Muestra $muestra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Muestra $muestra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Muestra $muestra)
    {
        //
    }
}