<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Recepcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reporteCaja()
    {
        $user = Auth::user();
        if ($user->rol == 'admin') {
            $cajas = Caja::where('caja_estado', '=', 0)->orderBy('updated_at', 'desc')->get();
        }else if ($user->rol == 'usuario') {
            $cajas = Caja::where([['user_id', '=', $user->id], ['caja_estado', '=', 0]])->orderBy('updated_at', 'desc')->get();
        }
        return view('reportes.reportCaja', [
            'cajas' => $cajas
        ]);
    }

    public function indexEstudio()
    {
        return view('reportes.reportEstudio');
    }

    public function getReportEstudio(Request $request)
    {
        $user = Auth::user();
        $fechaIn = $request->input('i');
        $fechaFin = $request->input('f');
        if ($user->rol == 'admin') {
            $recepcions = DB::table('recepcions as r')
                            ->join('detalles as d', 'd.id', '=', 'r.det_id')
                            ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                            ->join('grupos as g', 'g.id', '=', 'e.grupo_id')
                            ->join('facturas as f', 'f.id', '=', 'r.fac_id')
                            ->leftJoin('subgrupos as sg', 'sg.id', '=', 'e.subgrupo_id')
                            ->select('g.nombre as grupo', 'sg.nombre as subgrupo', 'd.id as estudio', 'e.est_cod', 'e.est_nombre', 'e.est_precio', 
                            DB::raw('COUNT(*) as cantidad'), 
                            DB::raw('(COUNT(*) * e.est_precio) as total'), 'e.est_moneda')
                            ->groupBy('g.nombre', 'sg.nombre', 'e.est_cod', 'e.est_nombre', 'e.est_precio', 'e.est_moneda', 'd.id');
            if ($fechaIn !== null && $fechaFin !== null) {
                $recepcions->whereBetween(DB::raw('DATE(f.created_at)'), [$fechaIn, $fechaFin]);
            }

            $recepcions = $recepcions->get();
        }else {
            $recepcions = DB::table('recepcions as r')
                            ->join('detalles as d', 'd.id', '=', 'r.det_id')
                            ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                            ->join('grupos as g', 'g.id', '=', 'e.grupo_id')
                            ->leftJoin('subgrupos as sg', 'sg.id', '=', 'e.subgrupo_id')
                            ->join('facturas as f', 'f.id', '=', 'r.fac_id')
                            ->join('cajas as c', 'c.id', '=', 'r.caja_id')
                            ->join('users as u', 'u.id', '=', 'c.user_id')
                            ->select('g.nombre as grupo', 'sg.nombre as subgrupo', 'd.id as estudio', 'e.est_cod', 'e.est_nombre', 'e.est_precio', 
                            DB::raw('COUNT(*) as cantidad'),
                            DB::raw('(COUNT(*) * e.est_precio) as total'), 'e.est_moneda')
                            ->where('u.id', '=', $user->id)
                            ->groupBy('g.nombre', 'sg.nombre', 'e.est_cod', 'e.est_nombre', 'e.est_precio', 'e.est_moneda', 'd.id');
            if ($fechaIn !== null && $fechaFin !== null) {
                $recepcions->whereBetween(DB::raw('DATE(f.created_at)'), [$fechaIn, $fechaFin]);
            }
            $recepcions = $recepcions->get();
        }

        return response()->json($recepcions);
    }

    public function reporteMaterial()
    {
        $user = Auth::user();
        
        return view('reportes.reporteMaterial');
    }

    public function reporteEconomico()
    {
        $user = Auth::user();

        return view('reportes.reporteEconomico');
    }
}
