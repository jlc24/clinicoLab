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

    public function reporteEstudio()
    {
        $user = Auth::user();
        if ($user->rol == 'admin') {
            $recepcions = DB::table('recepcions as r')
                            ->join('detalles as d', 'd.id', '=', 'r.det_id')
                            ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                            ->select('e.est_cod', 'e.est_nombre', 
                            DB::raw('COUNT(*) as cantidad'), 
                            DB::raw('(COUNT(*) * e.est_precio) as total'))
                            ->groupBy('e.est_cod', 'e.est_nombre', 'e.est_precio')
                            ->get();
        }else {
            $recepcions = DB::table('recepcions as r')
                            ->join('detalles as d', 'd.id', '=', 'r.det_id')
                            ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                            ->join('cajas as c', 'c.id', '=', 'r.caja_id')
                            ->join('users as u', 'u.id', '=', 'c.user_id')
                            ->select('e.est_cod', 'e.est_nombre', 
                            DB::raw('COUNT(*) as cantidad'),
                            DB::raw('(COUNT(*) * e.est_precio) as total'))
                            ->where('u.id', '=', $user->id)
                            ->groupBy('e.est_cod', 'e.est_nombre', 'e.est_precio')
                            ->get();
        }

        return view('reportes.reportEstudio', [
            'recepcions' => $recepcions
        ]);
    }
}
