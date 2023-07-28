<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Medico;
use App\Models\Recepcion;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contcli = Cliente::count();
        $contmed = Medico::count();
        $contrecep = Recepcion::count();
        $contUser = User::whereIn('rol', ['admin', 'usuario'])->count();
        return view('home', [
            'contcli' => $contcli,
            'contmed' => $contmed,
            'contrecep' => $contrecep,
            'contUser' => $contUser
        ]);
    }

    // public function ejemplo()
    // {
    //     return view('ejemplo.index');
    // }

    public function estudiosRecepcionados()
    {
        $recepcions = DB::table('recepcions as r')
                            ->join('detalles as d', 'd.id', '=', 'r.det_id')
                            ->join('estudios as e', 'd.estudio_id', '=', 'e.id')
                            ->select('e.est_cod', 'e.est_nombre', 
                            DB::raw('COUNT(*) as cantidad'), 
                            DB::raw('(COUNT(*) * e.est_precio) as total'))
                            ->groupBy('e.est_cod', 'e.est_nombre', 'e.est_precio')
                            ->get();
                            
        return response()->json($recepcions);
    }
}
