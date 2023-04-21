<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('resultado.index');
    }

    public function buscarRecepcionPaciente(Request $request)
    {
        $term = $request->input('q');
        $recepcion = DB::table('clientes')
                    ->join('facturas', 'facturas.cli_id', '=', 'clientes.id')
                    ->join('recepcions', 'recepcions.fac_id', '=', 'facturas.id')
                    ->join('detalles', 'recepcions.det_id', '=', 'detalles.id')
                    ->join('estudios', 'detalles.estudio_id', '=', 'estudios.id')
                    ->select('recepcions.id as numero', 
                            DB::raw("CONCAT(clientes.cli_nombre, ' ', 
                                            clientes.cli_apellido_pat, ' ', 
                                            clientes.cli_apellido_mat) AS nombre"), 
                            DB::raw("DATE_FORMAT(recepcions.created_at, '%d/%m/%Y') AS fecha"), 
                            'estudios.est_nombre as estudio', 
                            'estudios.est_cod as codigo', 
                            'recepcions.estado as estado')
                    ->where('clientes.id', $term)
                    ->get();
        return response()->json($recepcion);
    }

    public function buscarRecepcionEstudio(Request $request)
    {
        $term = $request->input('q');
        $recepcion = DB::table('estudios')
                    ->join('detalles', 'detalles.estudio_id', '=', 'estudios.id')
                    ->join('recepcions', 'recepcions.det_id', '=', 'detalles.id')
                    ->join('facturas', 'recepcions.fac_id', '=', 'facturas.id')
                    ->join('clientes', 'facturas.cli_id', '=', 'clientes.id')
                    ->select('recepcions.id as numero', 
                            DB::raw("CONCAT(clientes.cli_nombre, ' ', 
                                            clientes.cli_apellido_pat, ' ', 
                                            clientes.cli_apellido_mat) AS nombre"), 
                            DB::raw("DATE_FORMAT(recepcions.created_at, '%d/%m/%Y') AS fecha"), 
                            'estudios.est_nombre as estudio', 
                            'estudios.est_cod as codigo', 
                            'recepcions.estado as estado')
                    ->where('estudios.id', $term)
                    ->get();
        return response()->json($recepcion);
    }

    public function buscarRecepcionFechas(Request $request)
    {
        $fechaIni = $request->input('q');
        $fechaFin = $request->input('f');
        $recepcion = DB::table('recepcions')
                    ->join('facturas', 'recepcions.fac_id', '=', 'facturas.id')
                    ->join('clientes', 'facturas.cli_id', '=', 'clientes.id')
                    ->join('detalles', 'recepcions.det_id', '=', 'detalles.id')
                    ->join('estudios', 'detalles.estudio_id', '=', 'estudios.id')
                    ->select('recepcions.id as numero', 
                            DB::raw("CONCAT(clientes.cli_nombre, ' ', 
                                            clientes.cli_apellido_pat, ' ', 
                                            clientes.cli_apellido_mat) AS nombre"), 
                            DB::raw("DATE_FORMAT(recepcions.created_at, '%d/%m/%Y') AS fecha"), 
                            'estudios.est_nombre as estudio', 
                            'estudios.est_cod as codigo', 
                            'recepcions.estado as estado')
                    ->whereBetween(DB::raw('DATE(recepcions.created_at)'), [$fechaIni, $fechaFin])
                    ->get();
        return response()->json($recepcion);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
