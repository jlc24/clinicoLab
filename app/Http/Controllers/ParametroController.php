<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getParametro($id)
    {
        $parametro = Parametro::where('ca_id', '=', $id)->get();
        return response()->json($parametro);
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
            'ca_id' => 'integer'
        ]);

        Parametro::create([
            'ca_id' => $request->input('ca_id'),
            'genero' => $request->input('genero'),
            'edad_inicial' => $request->input('edad_inicial'),
            'edad_final' => $request->input('edad_final'),
            'tiempo' => $request->input('tiempo'),
            'valor_inicial' => $request->input('valor_inicial'),
            'valor_final' => $request->input('valor_final'),
            'referencia' => $request->input('referencia'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Parametro $parametro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parametro $parametro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ca_id' => 'integer'
        ]);
        $parametro = Parametro::find($id);
        $parametro->update([
            'ca_id' => $request->input('ca_id'),
            'genero' => $request->input('genero'),
            'edad_inicial' => $request->input('edad_inicial'),
            'edad_final' => $request->input('edad_final'),
            'tiempo' => $request->input('tiempo'),
            'valor_inicial' => $request->input('valor_inicial'),
            'valor_final' => $request->input('valor_final'),
            'referencia' => $request->input('referencia'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $parametro = Parametro::find($id);
        $parametro->delete();
    }
}
