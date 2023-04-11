<?php

namespace App\Http\Controllers;

use App\Models\Recipiente;
use Illuminate\Http\Request;

class RecipienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipientes = Recipiente::all();
        return view('recipiente.index', [ 'recipientes' => $recipientes]);
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
            'reci_nombre' => 'required|max:20',
            'reci_descripcion' => 'max:255',
        ]);

        Recipiente::create([
            'nombre' => $request->input('reci_nombre'),
            'descripcion' => $request->input('reci_descripcion'),
        ]);
        return redirect()->route('recipiente')->with('success', 'El registro se ha creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipiente $recipiente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipiente $recipiente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'reci_nombre' => 'required|max:20',
            'reci_descripcion' => 'max:255',
        ]);

        $recipiente = Recipiente::find($id);
        $recipiente->nombre = $request->input('reci_nombre');
        $recipiente->descripcion = $request->input('reci_descripcion');
        $recipiente->save();
        
        return redirect()->route('recipiente')->with('success', 'El registro se ha modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recipiente = Recipiente::find($id);
        $recipiente->delete();
        return response()->json(['success', 'El registro se ha eliminado con éxito']);
    }
}
