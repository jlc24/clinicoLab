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
            $recepcions = DB::table('result_detallematerials as rdm')
                            ->join('materials as m', 'm.id', '=', 'rdm.mat_id')
                            ->join('categorias AS c', 'c.id', '=', 'm.cat_id')
                            ->join('results AS res', 'res.id', '=', 'rdm.result_id')
                            ->join('detalles AS d', 'd.id', '=', 'res.det_id')
                            ->join('estudios AS e', 'e.id', '=', 'd.estudio_id')
                            ->join('recepcions as rec', 'rec.id', '=', 'res.rec_id')
                            ->where('rec.estado', 'RESULTADO')
                            //->whereBetween(DB::raw('DATE(rdm.updated_at)'), ['2023-08-09', '2023-08-09'])
                            ->select(
                                'e.est_cod', 'e.est_nombre',
                                DB::raw('COUNT(*) as cantidad'),
                                DB::raw('SUM(e.est_precio) as total'),
                                DB::raw('SUM(CASE WHEN c.id = 1 THEN rdm.precio_total ELSE 0 END) AS total_equipo'),
                                DB::raw('SUM(CASE WHEN c.id = 2 THEN rdm.precio_total ELSE 0 END) AS total_reactivo'),
                                DB::raw('SUM(CASE WHEN m.cat_id NOT IN (1, 2) THEN rdm.precio_total ELSE 0 END) AS total_otro'),
                                DB::raw('SUM(CASE WHEN c.id = 1 THEN rdm.precio_total ELSE 0 END) + SUM(CASE WHEN c.id = 2 THEN rdm.precio_total ELSE 0 END) + SUM(CASE WHEN m.cat_id NOT IN (1, 2) THEN rdm.precio_total ELSE 0 END) AS total_material')
                            )
                            ->groupBy('e.est_cod', 'e.est_nombre');
                            //->get();
            if ($fechaIn !== null && $fechaFin !== null) {
                $recepcions->whereBetween(DB::raw('DATE(rdm.updated_at)'), [$fechaIn, $fechaFin]);
            }

            $recepcions = $recepcions->get();
        }else {
            $recepcions = DB::table('result_detallematerials as rdm')
                            ->join('materials as m', 'm.id', '=', 'rdm.mat_id')
                            ->join('categorias AS c', 'c.id', '=', 'm.cat_id')
                            ->join('results AS res', 'res.id', '=', 'rdm.result_id')
                            ->join('detalles AS d', 'd.id', '=', 'res.det_id')
                            ->join('estudios AS e', 'e.id', '=', 'd.estudio_id')
                            ->join('recepcions as rec', 'rec.id', '=', 'res.rec_id')
                            ->join('facturas as f', 'f.id', '=', 'rec.fac_id')
                            ->join('users as u', 'u.id', '=', 'f.user_id')
                            ->where([['rec.estado', 'RESULTADO'], ['u.id', '=', $user->id]])
                            //->whereBetween(DB::raw('DATE(rdm.updated_at)'), ['2023-08-09', '2023-08-09'])
                            ->select(
                                'e.est_cod', 'e.est_nombre',
                                DB::raw('COUNT(*) as cantidad'),
                                DB::raw('SUM(e.est_precio) as total'),
                                DB::raw('SUM(CASE WHEN c.id = 1 THEN rdm.precio_total ELSE 0 END) AS total_equipo'),
                                DB::raw('SUM(CASE WHEN c.id = 2 THEN rdm.precio_total ELSE 0 END) AS total_reactivo'),
                                DB::raw('SUM(CASE WHEN m.cat_id NOT IN (1, 2) THEN rdm.precio_total ELSE 0 END) AS total_otro'),
                                DB::raw('SUM(CASE WHEN c.id = 1 THEN rdm.precio_total ELSE 0 END) + SUM(CASE WHEN c.id = 2 THEN rdm.precio_total ELSE 0 END) + SUM(CASE WHEN m.cat_id NOT IN (1, 2) THEN rdm.precio_total ELSE 0 END) AS total_material')
                            )
                            ->groupBy('e.est_cod', 'e.est_nombre');
                            //->get();
            if ($fechaIn !== null && $fechaFin !== null) {
                $recepcions->whereBetween(DB::raw('DATE(rdm.updated_at)'), [$fechaIn, $fechaFin]);
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
