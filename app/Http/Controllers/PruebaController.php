<?php

namespace App\Http\Controllers;

use App\Models\UMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    public function index()
    {
        return view('pruebas.index', [
            'unidades' => UMedida::all()
        ]);
    }

    public function getResultsPruebas(Request $request)
    {
        $fechaIni = $request->input('q');
        $fechaFin = $request->input('f');
        $estado = $request->input('r');
        if ($estado !== 'TODO') {
            $pruebas = DB::table('aspectos as a')
                        ->join('componente_aspectos as ca', 'ca.asp_id', '=', 'a.id')
                        ->join('results as res', 'ca.id', '=', 'res.ca_id')
                        ->join('recepcions as r', 'res.rec_id', '=', 'r.id')
                        ->join('facturas as f', 'r.fac_id', '=', 'f.id')
                        ->join('clientes as c', 'f.cli_id', '=', 'c.id')
                        ->join('detalles as d', 'r.det_id', '=', 'd.id')
                        ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                        ->join('grupos as g', 'g.id', '=', 'e.grupo_id')
                        ->leftJoin('subgrupos as sg', 'sg.id', '=', 'e.subgrupo_id')
                        ->select('ca.id as numero', 'a.nombre as prueba','e.est_nombre as estudio', 'sg.nombre as subgrupo', 'g.nombre as grupo', 'r.estado as estado')
                        ->distinct()
                        ->where('res.estado', '=', $estado)
                        ->whereBetween(DB::raw('DATE(r.created_at)'), [$fechaIni, $fechaFin])
                        ->get();
        }else{
            $pruebas = DB::table('aspectos as a')
                        ->join('componente_aspectos as ca', 'ca.asp_id', '=', 'a.id')
                        ->join('results as res', 'ca.id', '=', 'res.ca_id')
                        ->join('recepcions as r', 'res.rec_id', '=', 'r.id')
                        ->join('facturas as f', 'r.fac_id', '=', 'f.id')
                        ->join('clientes as c', 'f.cli_id', '=', 'c.id')
                        ->join('detalles as d', 'r.det_id', '=', 'd.id')
                        ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                        ->join('grupos as g', 'g.id', '=', 'e.grupo_id')
                        ->leftJoin('subgrupos as sg', 'sg.id', '=', 'e.subgrupo_id')
                        ->select('ca.id as numero', 'a.nombre as prueba','e.est_nombre as estudio', 'sg.nombre as subgrupo', 'g.nombre as grupo', 'r.estado as estado')
                        ->distinct()
                        ->whereBetween(DB::raw('DATE(r.created_at)'), [$fechaIni, $fechaFin])
                        ->get();
        }
        return response()->json($pruebas);
    }

    public function getPrueba($id)
    {
        $prueba = DB::table('aspectos as a')
                        ->join('componente_aspectos as ca', 'ca.asp_id', '=', 'a.id')
                        ->join('results as res', 'ca.id', '=', 'res.ca_id')
                        ->join('recepcions as r', 'res.rec_id', '=', 'r.id')
                        ->join('facturas as f', 'r.fac_id', '=', 'f.id')
                        ->join('detalles as d', 'r.det_id', '=', 'd.id')
                        ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                        ->join('grupos as g', 'g.id', '=', 'e.grupo_id')
                        ->leftJoin('subgrupos as sg', 'sg.id', '=', 'e.subgrupo_id')
                        ->select('e.est_nombre as estudio', 'g.nombre as grupo', 'sg.nombre as subgrupo')
                        ->distinct()
                        ->where('ca.id', '=', $id)
                        ->get();
        return response()->json($prueba);
    }

    public function getPruebaPacientes($id)
    {
        $pacientes = DB::table('clientes as c')
                        ->join('facturas as f', 'f.cli_id', '=', 'c.id')
                        ->join('results as res', 'res.fac_id', '=', 'f.id')
                        ->join('componente_aspectos as ca', 'res.ca_id', '=', 'ca.id')
                        ->join('aspectos as a', 'ca.asp_id', '=', 'a.id')
                        ->join('recepcions as r', 'res.rec_id', '=','r.id')
                        ->join('detalles as d', 'r.det_id', '=', 'd.id')
                        ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                        ->join('grupos as g', 'g.id', '=', 'e.grupo_id')
                        ->leftJoin('subgrupos as sg', 'sg.id', '=', 'e.subgrupo_id')
                        ->select('res.id', 'c.cli_cod', 'res.resultado', 'res.umed_id', 'res.estado')
                        ->where([['res.ca_id', '=', $id], ['r.estado', '=', 'PENDIENTE']])
                        ->orderBy('c.id')
                        ->get();
        return response()->json($pacientes);
    }
}
