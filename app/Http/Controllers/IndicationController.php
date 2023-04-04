<?php

namespace App\Http\Controllers;

use App\Models\Indication;
use Illuminate\Http\Request;

class IndicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indications = Indication::all();
        return view('indication.index', ['indications' => $indications]);
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
            'indi_nombre' => 'required|max:20',
            'indi_descripcion' => 'required|max:255',
        ]);

        Indication::create([
            'nombre' => $request->input('indi_nombre'),
            'descripcion' => $request->input('indi_descripcion'),
        ]);

        return redirect()->route('indication')->with('success', 'El registro se ha creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Indication $indication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indication $indication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'indi_nombre' => 'required|max:20',
            'indi_descripcion' => 'required|max:255',
        ]);

        $indication = Indication::find($id);
        $indication->nombre = $request->input('indi_nombre');
        $indication->descripcion = $request->input('indi_descripcion');
        $indication->save();

        return redirect()->route('indication')->with('success', 'El registro se ha modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $indication = Indication::find($id);
        $indication->delete();

        return response()->json(['success' => 'El registro se ha eliminado con éxito']);
    }
}
