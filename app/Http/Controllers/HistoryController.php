<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Recepcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function historyViewRecepcion()
    {
        $user = Auth::user();
        if ($user->rol == 'admin') {
            $recepcions = DB::table('recepcions as r')
                                ->join('detalles as d', 'd.id', '=', 'r.det_id')
                                ->join('estudios as e', 'e.id', '=', 'd.estudio_id')
                                ->join('cajas as c', 'c.id', '=', 'r.caja_id')
                                ->join('users as u', 'u.id', '=', 'c.user_id')
                                ->join('facturas as f', 'f.id', '=', 'r.fac_id')
                                ->join('clientes as cli', 'cli.id', '=', 'f.cli_id')
                                ->select('r.id as rec_id',
                                    DB::raw("CONCAT(cli.cli_nombre, ' ', 
                                                    cli.cli_apellido_pat, ' ', 
                                                    cli.cli_apellido_mat) AS nombre"), 
                                    DB::raw("DATE_FORMAT(r.created_at, '%d/%m/%Y') AS fecha"),
                                    'e.est_nombre', 'e.est_cod', 'r.estado')
                                ->orderBy('fecha')
                                ->get();

            $cajas = DB::table('cajas as c')
                    ->join('users as u', 'u.id', 'c.user_id')
                    ->select('c.id')
                    ->get();

        }elseif ($user->rol == 'usuario' || $user->rol == 'medico') {
            $recepcions = DB::table('recepcions as r')
                                ->join('detalles as d', 'd.id', '=', 'r.det_id')
                                ->join('estudios as e', 'e.id', '=', 'd.estudio_id')
                                ->join('cajas as c', 'c.id', '=', 'r.caja_id')
                                ->join('users as u', 'u.id', '=', 'c.user_id')
                                ->join('facturas as f', 'f.id', '=', 'r.fac_id')
                                ->join('clientes as cli', 'cli.id', '=', 'f.cli_id')
                                ->select('r.id as rec_id',
                                    DB::raw("CONCAT(cli.cli_nombre, ' ', 
                                                    cli.cli_apellido_pat, ' ', 
                                                    cli.cli_apellido_mat) AS nombre"), 
                                    DB::raw("DATE_FORMAT(r.created_at, '%d/%m/%Y') AS fecha"),
                                    'e.est_nombre', 'e.est_cod', 'r.estado')
                                ->orderBy('fecha')
                                ->where('u.id', '=', $user->id)
                                ->get();
            
            $cajas = DB::table('cajas as c')
                    ->join('users as u', 'u.id', 'c.user_id')
                    ->select('c.id')
                    ->where('u.id', '=', $user->id)
                    ->get();

        }

        $usuarios = User::whereIn('rol', ['admin', 'usuario'])->get();

        return view('history.history_recepcion', [
            'recepcions' => $recepcions,
            'estudios' => Estudio::all(),
            'cajas' => $cajas,
            'usuarios' => $usuarios
        ]);
    }
    
    public function historyRecepcion(Request $request)
    {
        $user = Auth::user();
        $fecha = $request->input('f');
        $estudio = $request->input('e');
        $caja = $request->input('c');
        $usuario = $request->input('u');
        if ($user->rol == 'admin') {
            $recepcion = DB::table('recepcions as r')
                            ->join('detalles as d', 'd.id', '=', 'r.det_id')
                            ->join('estudios as e', 'e.id', '=', 'd.estudio_id')
                            ->join('cajas as c', 'c.id', '=', 'r.caja_id')
                            ->join('users as u', 'u.id', '=', 'c.user_id')
                            ->join('facturas as f', 'f.id', '=', 'r.fac_id')
                            ->join('clientes as cli', 'cli.id', '=', 'f.cli_id')
                            ->select('r.id as rec_id',
                                DB::raw("CONCAT(cli.cli_nombre, ' ', 
                                                cli.cli_apellido_pat, ' ', 
                                                cli.cli_apellido_mat) AS nombre"), 
                                DB::raw("DATE_FORMAT(r.created_at, '%d/%m/%Y') AS fecha"),
                                'e.est_nombre', 'e.est_cod', 'r.estado')
                            ->orderBy('fecha');
        if ($fecha) {
            $recepcion->whereDate('r.created_at',  $fecha);
        }

        if ($estudio) {
            $recepcion->where('e.id', '=', $estudio);
        }
        
        if ($caja) {
            $recepcion->where('c.id', $caja);
        }
        
        if ($usuario) {
            $recepcion->where('u.id', $usuario);
        }
        
        $recepcion = $recepcion->get();

        }elseif ($user->rol == 'usuario' || $user->rol == 'medico') {
            $recepcion = DB::table('recepcions as r')
                            ->join('detalles as d', 'd.id', '=', 'r.det_id')
                            ->join('estudios as e', 'e.id', '=', 'd.estudio_id')
                            ->join('cajas as c', 'c.id', '=', 'r.caja_id')
                            ->join('users as u', 'u.id', '=', 'c.user_id')
                            ->join('facturas as f', 'f.id', '=', 'r.fac_id')
                            ->join('clientes as cli', 'cli.id', '=', 'f.cli_id')
                            ->select('r.id as rec_id',
                                DB::raw("CONCAT(cli.cli_nombre, ' ', 
                                                cli.cli_apellido_pat, ' ', 
                                                cli.cli_apellido_mat) AS nombre"), 
                                DB::raw("DATE_FORMAT(r.created_at, '%d/%m/%Y') AS fecha"),
                                'e.est_nombre', 'e.est_cod', 'r.estado')
                            ->orderBy('fecha');
                            if ($fecha) {
                                $recepcion->whereDate('r.created_at',  $fecha);
                            }

                            if ($estudio) {
                                $recepcion->where('e.id', '=', $estudio);
                            }
                            
                            if ($caja) {
                                $recepcion->where('c.id', $caja);
                            }
                            $recepcion->where('u.id', '=', $user->id);
                            
                            $recepcion = $recepcion->get();
        }
        
        return response()->json($recepcion);
    }
}
