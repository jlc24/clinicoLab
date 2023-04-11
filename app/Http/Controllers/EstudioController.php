<?php

namespace App\Http\Controllers;

use App\Models\Detalle;
use App\Models\Estudio;
use App\Models\Indication;
use App\Models\Muestra;
use App\Models\Recipiente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class EstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('estudio.index',[
            'muestras' => Muestra::all(),
            'recipientes' => Recipiente::all(),
            'indicaciones' => Indication::all(),
            'detalles' => Detalle::all(),
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
        $validator = Validator::make($request->all(), [
            'est_cod' => 'required|unique:estudios|max:10',
            'est_nombre' => 'required|max:255',
            'est_descripcion' => 'max:255',
            'est_muestra' => 'required',
            'est_recipiente' => 'required',
            'est_indicaciones' => 'required',
            'est_precio' => 'required|decimal:2',
            'est_moneda' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $estudio = Estudio::create([
            'est_cod' => $request->input('est_cod'),
            'est_nombre' => $request->input('est_nombre'),
            'est_descripcion' => $request->input('est_descripcion'),
            'est_precio' => $request->input('est_precio'),
            'est_moneda' => $request->input('est_moneda')
        ]);

        Detalle::create([
            'estudio_id' => $estudio->id,
            'muestra_id' => $request->input('est_muestra'),
            'recipiente_id' => $request->input('est_recipiente'),
            'indicacion_id' => $request->input('est_indicaciones'),
        ]);

        return redirect()->route('estudio')->with('success', 'El registro se ha creado con éxito');

    }

    /**
     * Display the specified resource.
     */
    public function show(Estudio $estudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudio $estudio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'est_cod' => 'required|max:10|unique:estudios,est_cod,'.$id,
            'est_nombre' => 'required|max:255',
            'est_descripcion' => 'max:255',
            'est_muestra' => 'required',
            'est_recipiente' => 'required',
            'est_indicaciones' => 'required',
            'est_precio' => 'required|decimal:2',
            'est_moneda' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $estudio = Estudio::find($id);
        $estudio->update([
            'est_cod' => $request->input('est_cod'),
            'est_nombre' => $request->input('est_nombre'),
            'est_descripcion' => $request->input('est_descripcion'),
            'est_precio' => $request->input('est_precio'),
            'est_moneda' => $request->input('est_moneda')
        ]);

        $detalle = Detalle::where('estudio_id', '=', $id)->first();
        $detalle->update([
            'estudio_id' => $estudio->id,
            'muestra_id' => $request->input('est_muestra'),
            'recipiente_id' => $request->input('est_recipiente'),
            'indicacion_id' => $request->input('est_indicaciones'),
        ]);

        return redirect()->route('estudio')->with('success', 'El registro se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudio $estudio)
    {
        //
    }
}
