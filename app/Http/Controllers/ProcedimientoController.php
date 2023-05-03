<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use App\Models\DetalleComponente;
use App\Models\DetalleProcedimiento;
use App\Models\Procedimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getLastProcedimiento()
    {
        $procedimiento = Procedimiento::orderBy('created_at', 'desc')->first();

        return response()->json($procedimiento);
    }

    public function getAllProcedimiento()
    {
        $procedimiento = Procedimiento::all();
        return response()->json($procedimiento);
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
            'proc_nombre' => 'required|max:255',
            'proc_metodo' => 'integer',
            'det_id' => 'integer',
            'nombre' => 'max:100'
        ]);

        $procedimiento = Procedimiento::create([
            'nombre' => $request->input('proc_nombre'),
            'metodo_id' => $request->input('proc_metodo'),
        ]);

        DetalleProcedimiento::create([
            'det_id' => $request->input('det_id'),
            'proc_id'=> $procedimiento->id,
            'estado' => '0'
        ]);
    }

    public function storeDetalleProc(Request $request)
    {
        $request->validate([
            'det_id' => 'integer',
            'proc_id' => 'integer',
            'nombre' => 'max:100'
        ]);
        
        DetalleProcedimiento::create([
            'det_id' => $request->input('det_id'),
            'proc_id'=> $request->input('proc_id'),
            'estado' => '0'
        ]);
    }

    public function destroyDetalleProc($id)
    {
        $detproc = DetalleProcedimiento::find($id);
        $detproc->delete();
    }

    /**
     * Display the specified resource.
     */
    public function show(Procedimiento $procedimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Procedimiento $procedimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Procedimiento $procedimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Procedimiento $procedimiento)
    {
        //
    }
}
