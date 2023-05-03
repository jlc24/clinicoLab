<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use App\Models\DetalleComponente;
use App\Models\DetalleProcedimiento;
use Illuminate\Http\Request;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('componente.index', [
            'componentes' => Componente::all(),
        ]);
    }

    public function getAllComponente()
    {
        $componente = Componente::all();
        return response()->json($componente);
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
            'comp_nombre'=> 'required|max:100'
        ]);

        $componente = Componente::create([
            'nombre' => $request->input('comp_nombre'),
        ]);

        
        //return redirect()->route('componente')->with('success', 'El registro se ha creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Componente $componente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Componente $componente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comp_nombre_update' => 'required|max:100',
        ]);

        $componente = Componente::find($id);
        $componente->nombre = $request->input('comp_nombre_update');
        $componente->save();

        return redirect()->route('componente')->with('success', 'El registro se ha modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $componente = Componente::find($id);
        $componente->delete();

    }

    public function destroyDetComp($id)
    {
        $det_comp = DetalleComponente::find($id);
        $det_comp->delete();
    }
}
