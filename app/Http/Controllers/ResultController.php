<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Material;
use App\Models\Recepcion;
use App\Models\Result;
use App\Models\ResultDetallematerial;
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

    public function resultPaciente()
    {
        return view('resultado.paciente',[
            'unidades' => UMedida::all()
        ]);
    }

    public function getResults()
    {
        $results = DB::table('clientes as c')
                        ->join('facturas as f', 'f.cli_id', '=', 'c.id')
                        ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                        ->join('detalles as d', 'r.det_id', '=', 'd.id')
                        ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                        ->select('r.id as numero', 'r.rec_codigo', 
                                DB::raw("CONCAT(c.cli_nombre, ' ', 
                                                c.cli_apellido_pat, ' ', 
                                                c.cli_apellido_mat) AS nombre"), 
                                DB::raw("DATE_FORMAT(r.updated_at, '%d/%m/%Y') AS fecha"), 
                                DB::raw("DATE_FORMAT(r.updated_at, '%H:%i') as hora"), 
                                'e.est_nombre as estudio', 
                                'r.estado as estado')
                        ->where('r.estado', '=', 'RESULTADO')
                        ->get();
        return view('result.index', [
            'results' => $results
        ]);
    }

    public function buscarRecepcionPaciente(Request $request)
    {
        $term = $request->input('q');
        $estado = $request->input('r');
        if ($estado !== 'TODO') {
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
                        ->where([['clientes.id', '=', $term], ['recepcions.estado', '=', $estado]])
                        ->get();
        }else{
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
                        ->where([['clientes.id', '=', $term], ['recepcions.estado', '=', $estado]])
                        ->get();
        }
        return response()->json($recepcion);
    }

    public function buscarRecepcionEstudio(Request $request)
    {
        $term = $request->input('q');
        $estado = $request->input('r');
        if ($estado !== 'TODO') {
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
                        ->where([['estudios.id', '=', $term], ['recepcions.estado', '=', $estado]])
                        ->get();
        }else{
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
                        ->where([['recepcions.estado', '=', $estado],['estudios.id', $term]])
                        ->get();
        }
        return response()->json($recepcion);
    }

    public function buscarRecepcionFechas(Request $request)
    {
        $fechaIni = $request->input('q');
        $fechaFin = $request->input('f');
        $estado = $request->input('r');
        if ($estado !== 'TODO') {
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
                        ->where('recepcions.estado', '=', $estado)
                        ->whereBetween(DB::raw('DATE(recepcions.created_at)'), [$fechaIni, $fechaFin])
                        ->get();
        }else{
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
                        ->where('recepcions.estado', '=', $estado)
                        ->whereBetween(DB::raw('DATE(recepcions.created_at)'), [$fechaIni, $fechaFin])
                        ->get();
        }
        return response()->json($recepcion);
    }

    public function getClienteResult($id)
    {
        $pacientes = DB::table('clientes as c')
                            ->join('facturas as f', 'f.cli_id', '=', 'c.id')
                            ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                            ->join('detalles as d', 'r.det_id', '=', 'd.id')
                            ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                            ->select('f.id as fac_id', 'r.id as rec_id','c.id as cli_id', DB::raw("CONCAT(c.cli_nombre, ' ', 
                                                    c.cli_apellido_pat, ' ', 
                                                    c.cli_apellido_mat) AS nombre"), 'c.cli_fec_nac',
                                    DB::raw("DATE_FORMAT(r.created_at, '%d/%m/%Y') AS fecha"), 'c.cli_genero', 'f.fac_observacion', 'f.fac_referencia', 'e.est_nombre', 'd.id as det_id', 'r.estado', 'r.rec_observacion')
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

    public function getDPCAspectoResult(Request $request)
    {
        $fac_id = $request->input('f');
        $rec_id = $request->input('r');
        $det_id = $request->input('d');
        $dp_id = $request->input('p');
        $dpc_id = $request->input('c');
        $dpaspecto = DB::table('componente_aspectos as ca')
                        ->join('results as res', 'res.ca_id', '=', 'ca.id')
                        ->leftJoin('parametros as p', 'p.id', '=', 'res.param_id')
                        ->join('dp_componentes as dpc', 'ca.dpcomp_id', '=', 'dpc.id')
                        ->join('aspectos as a', 'ca.asp_id', '=', 'a.id')
                        ->select('res.id', 'res.fac_id', 'res.rec_id', 'res.det_id', 'res.dp_id', 'res.dpc_id' , 'res.ca_id', 'a.nombre', 'res.resultado', 'res.umed_id',
                        DB::raw('(SELECT COUNT(*) FROM parametros WHERE ca_id = ca.id) as cant_parametros'), 'p.referencia')
                        ->where([
                            ['res.fac_id', '=', $fac_id], 
                            ['res.rec_id', '=', $rec_id], 
                            ['res.det_id', '=', $det_id], 
                            ['res.dp_id', '=', $dp_id], 
                            ['res.dpc_id', '=', $dpc_id]
                            ])
                        ->get();
        return response()->json($dpaspecto);
    }

    public function updateEstadoRecepcion(Request $request, $id)
    {
        $recepcion = Recepcion::find($id);
        $recepcion->estado = $request->input('res_estado');
        $recepcion->save();

        $paciente = DB::table('clientes as c')
                    ->join('facturas as f', 'f.cli_id', 'c.id')
                    ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                    ->select('c.*')
                    ->where('r.id', '=', $recepcion->id)
                    ->first();
        
        $randomNumber = mt_rand(1000000, 9999999);

        $recCodigo = $recepcion->id.$paciente->cli_cod.$randomNumber;
        $recfile = Recepcion::find($id);
        $recfile->rec_codigo = $recCodigo;
        $recfile->save();
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
    public function show($id)
    {
        $recepcion = Recepcion::find($id);
        return response()->json($recepcion);
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
    public function update(Request $request, $id)
    {
        $result = Result::find($id);
        $result->param_id = $request->input('parametro');
        $result->resultado = $request->input('resultado');
        $result->umed_id = $request->input('umed_id');
        $result->save();
        
        if ($result->estado === 0) {
            $mat_ests = DB::table('detalle_materials as dm')
                            ->join('materials as m', 'dm.mat_id', '=', 'm.id')
                            ->select('dm.*', 'm.mat_nombre', 'm.mat_precio_compra', 'm.mat_cantidad')
                            ->where('dm.ca_id', '=', $result->ca_id)
                            ->where('m.mat_estado', '=', '1')
                            ->get();
            foreach ($mat_ests as $mat_est) {
                $material = Material::find($mat_est->mat_id);
                $material->mat_ventas = $mat_est->cantidad + $material->mat_ventas;
                $material->save();

                ResultDetallematerial::create([
                    'result_id' => $result->id,
                    'detmat_id' => $mat_est->id,
                    'ca_id' => $mat_est->ca_id,
                    'mat_id' =>$mat_est->mat_id,
                    'cantidad' =>$mat_est->cantidad,
                    'umed_id' => $mat_est->umed_id,
                    'precio_total' => $mat_est->precio_total
                ]);
            }

            $result->estado = 1;
            $result->save();
        }
    }

    public function updateEstadoPrueba(Request $request, $id)
    {
        if ($request->input('pruebaEstado') !== null) {
            $result = Result::find($id);
            $result->param_id = null;
            $result->resultado = null;
            $result->umed_id = null;
            $result->estado = 0;
            $result->save();
            
            $mat_ests = DB::table('detalle_materials as dm')
                            ->join('materials as m', 'dm.mat_id', '=', 'm.id')
                            ->select('dm.*', 'm.mat_nombre', 'm.mat_precio_compra', 'm.mat_cantidad')
                            ->where('dm.ca_id', '=', $result->ca_id)
                            ->where('m.mat_estado', '=', '1')
                            ->get();
            foreach ($mat_ests as $mat_est) {
                $material = Material::find($mat_est->mat_id);
                $material->mat_ventas = $material->mat_ventas - $mat_est->cantidad;
                $material->save();
            }
            
            $resultDetmat = ResultDetallematerial::where('result_id', '=', $result->id);
            $resultDetmat->delete();

        }
    }

    public function updateObservacion(Request $request, $id)
    {
        $recepcion = Recepcion::find($id);
        $recepcion->rec_observacion = $request->input('rec_observacion');
        $recepcion->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
