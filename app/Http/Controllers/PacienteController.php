<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    public function index()
    {
        $cli_id = Auth::user()->cliente->id;
        $estudios = DB::table('recepcions as r')
                        ->join('facturas as f', 'r.fac_id', '=', 'f.id')
                        ->join('clientes as c', 'f.cli_id', '=', 'c.id')
                        ->join('detalles as d', 'r.det_id', '=', 'd.id')
                        ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                        ->select('f.id as factura', 'r.id as rec_id', 'r.rec_codigo', 'e.est_cod', 'e.est_nombre', 
                                DB::raw("DATE_FORMAT(r.created_at, '%d/%m/%Y') AS fecha"), 'r.estado')
                        ->where('c.id', '=', $cli_id)
                        ->get();
        return view('paciente.index', ['estudios' => $estudios]);
    }
}
