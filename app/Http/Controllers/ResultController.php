<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Result;
use App\Models\UMedida;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('resultado.index', [
            'unidades' => UMedida::all()
        ]);
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
                            'detalles.id as det_id',
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
                            'detalles.id as det_id',
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
                            'detalles.id as det_id',
                            'estudios.est_nombre as estudio', 
                            'estudios.est_cod as codigo', 
                            'recepcions.estado as estado')
                    ->whereBetween(DB::raw('DATE(recepcions.created_at)'), [$fechaIni, $fechaFin])
                    ->get();
        return response()->json($recepcion);
    }

    public function getClienteResult($id)
    {
        $pacientes = DB::table('clientes as c')
                            ->join('facturas as f', 'f.cli_id', '=', 'c.id')
                            ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                            ->join('detalles as d', 'r.det_id', '=', 'd.id')
                            ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                            ->select('r.id as rec_id','c.id as cli_id', DB::raw("CONCAT(c.cli_nombre, ' ', 
                                                    c.cli_apellido_pat, ' ', 
                                                    c.cli_apellido_mat) AS nombre"), 'c.cli_fec_nac',
                                    DB::raw("DATE_FORMAT(r.created_at, '%d/%m/%Y') AS fecha"), 'c.cli_genero', 'f.fac_observacion', 'f.fac_referencia', 'e.est_nombre', 'd.id as det_id')
                            ->where('r.id', '=', $id)
                            ->get();
        
        foreach ($pacientes as $paciente ) {
            $fecha_nac = new DateTime($paciente->cli_fec_nac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nac)->y;
            $paciente->edad = $edad;
        }
        return response()->json($pacientes);
    }

    public function searchResultRecepcions(Request $request)
    {
        $rec_id = $request->input('r');
        $det_id = $request->input('d');
        $dp_id = $request->input('p');
        $dpc_id = $request->input('c');
        $ca_id = $request->input('a');

        $results = DB::table('results as r')
                        ->where([
                            ['rec_id', '=', $rec_id],
                            ['det_id', '=', $det_id],
                            ['dp_id', '=', $dp_id],
                            ['dpc_id', '=', $dpc_id],
                            ['ca_id', '=', $ca_id]
                        ])
                        ->select('r.resultado')
                        ->get();
        return response()->json($results);
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
        $rec_id = $request->input('rec_id');
        $det_id = $request->input('det_id');
        $dp_id = $request->input('dp_id');
        $dpc_id = $request->input('dpc_id');
        $ca_id = $request->input('ca_id');
        $resultado = $request->input('resultado');

        Result::create([
            'rec_id' => $rec_id,
            'det_id' => $det_id,
            'dp_id' => $dp_id,
            'dpc_id' => $dpc_id,
            'ca_id' => $ca_id,
            'resultado' => $resultado
        ]);
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
