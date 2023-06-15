<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Factura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();
        if ($usuario->rol == 'admin') {
            $cajas = Caja::orderByDesc('created_at')->get();
        } elseif ($usuario->rol == 'usuario') {
            $cajas = Caja::where('user_id', '=', $usuario->id)->orderByDesc('created_at')->get();
        }
        $totalFactura = Factura::where('user_id', '=', $usuario->id)->whereDate('updated_at', Carbon::today())->sum('fac_total');
        
        return view('caja.index', [ 
            'cajas' => $cajas,
            'totalFacturas' => $totalFactura
        ]);
    }

    public function getCajaStatus()
    {
        $user = Auth::user();
        $caja = Caja::where('user_id', '=', $user->id)->latest()->first();
        return response()->json($caja);
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
        $request->validate([
            'caja_monto_apertura' => 'required',
            'caja_estado' => 'required'
        ]);

        $usuario = Auth::user();
        Caja::create([
            'user_id' => $usuario->id,
            'caja_monto_inicial' => $request->input('caja_monto_apertura'),
            'caja_estado' => $request->input('caja_estado')
        ]);

        return redirect()->route('caja')->with('success', 'El registro se ha creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $caja = DB::table('cajas as c')
                    ->join('users as u', 'c.user_id', '=', 'u.id')
                    ->select('c.*', 'u.user', 'c.created_at')
                    ->where('c.id', '=', $id)
                    ->get();
        $fecha_creacion = date('Y-m-d', strtotime($caja[0]->created_at));
        $fecha_actual = date('Y-m-d');
        if ($fecha_creacion === $fecha_actual) {
            $totalFactura = Factura::where('user_id', '=', $caja[0]->user_id)->whereDate('updated_at', Carbon::today())->sum('fac_total');
        }else  {
            $totalFactura = Factura::where('user_id', '=', $caja[0]->user_id)->whereDate('updated_at', $fecha_creacion)->sum('fac_total');

        }
        $caja[0]->total_factura = $totalFactura;
        return response()->json($caja);
    }

    public function getFacturasCaja($id)
    {
        $user = Auth::user();
        $caja = Caja::find($id);
        $fecha_creacion = date('Y-m-d', strtotime($caja->created_at));
        $fecha_actual = date('Y-m-d');
        if ($user->rol == 'admin') {
            if ($fecha_creacion === $fecha_actual) {
                $facturas = DB::table('facturas as f')
                                ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                                ->join('cajas as c', 'r.caja_id', '=', 'c.id')
                                ->select(DB::raw('DISTINCT f.id'), 'f.fac_pago', 
                                DB::raw("DATE_FORMAT(f.updated_at, '%d-%m-%Y') as fecha"),
                                DB::raw("DATE_FORMAT(f.updated_at, '%H:%i') as hora"), 'f.fac_total')
                                ->where([['f.user_id', '=', $user->id], ['f.fac_estado', '=', '1'], ['c.id', '=', $id]])
                                ->whereDate('f.updated_at', Carbon::today())
                                ->get();
            }else  {
                $facturas = DB::table('facturas as f')
                                ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                                ->join('cajas as c', 'r.caja_id', '=', 'c.id')
                                ->select(DB::raw('DISTINCT f.id'), 'f.fac_pago', 
                                DB::raw("DATE_FORMAT(f.updated_at, '%d-%m-%Y') as fecha"),
                                DB::raw("DATE_FORMAT(f.updated_at, '%H:%i') as hora"), 'f.fac_total')
                                ->where([['f.user_id', '=', $user->id], ['f.fac_estado', '=', '1'], ['c.id', '=', $id]])
                                ->whereDate('f.updated_at', $fecha_creacion)
                                ->get();
            }
        }else if ($user->rol == 'usuario' || $user->rol == 'medico') {
            if ($fecha_creacion === $fecha_actual) {
                $facturas = DB::table('facturas as f')
                                ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                                ->join('cajas as c', 'r.caja_id', '=', 'c.id')
                                ->select(DB::raw('DISTINCT f.id'), 'f.fac_pago', 
                                DB::raw("DATE_FORMAT(f.updated_at, '%d-%m-%Y') as fecha"),
                                DB::raw("DATE_FORMAT(f.updated_at, '%H:%i') as hora"), 'f.fac_total')
                                ->where([['f.user_id', '=', $user->id], ['c.id', '=', $id], ['f.fac_estado', '=', '1']])
                                ->whereDate('f.updated_at', Carbon::today())
                                ->get();
            }else  {
                $facturas = DB::table('facturas as f')
                                ->join('recepcions as r', 'r.fac_id', '=', 'f.id')
                                ->join('cajas as c', 'r.caja_id', '=', 'c.id')
                                ->select(DB::raw('DISTINCT f.id'), 'f.fac_pago', 
                                DB::raw("DATE_FORMAT(f.updated_at, '%d-%m-%Y') as fecha"),
                                DB::raw("DATE_FORMAT(f.updated_at, '%H:%i') as hora"), 'f.fac_total')
                                ->where([['f.user_id', '=', $user->id], ['c.id', '=', $id], ['f.fac_estado', '=', '1']])
                                ->whereDate('f.updated_at', $fecha_creacion)
                                ->get();
            }
        }
        return response()->json($facturas);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'caja_monto_cierre' => 'required',
            'caja_estado' => 'required',
            'caja_cambio' => 'required',
        ]);

        $caja = Caja::find($id);
        $caja->update([
            'caja_monto_final' => $request->input('caja_monto_cierre'),
            'caja_estado' => 0,
            'caja_cambio' => $request->input('caja_cambio')
        ]);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $caja)
    {
        //
    }
}
