<?php

namespace App\Http\Controllers;

use App\Models\DetalleProcedimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleProcedimientoController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'integer'
        ]);

        $det_proc = DetalleProcedimiento::find($id);
        $det_proc->estado = $request->input('estado');
        $det_proc->save();
    }

    public function getCompProcedimientoEstudio(Request $request)
    {
        $det_id = $request->input('q');
        $proc_id = $request->input('f');
        $comp_proc_est = DB::table('componentes')
                        ->join('detalle_componentes as dc', 'componentes.id', '=', 'dc.comp_id')
                        ->join('procedimientos as p', 'dc.proc_id', '=', 'p.id')
                        ->join('detalle_procedimientos as dp', 'dp.proc_id', '=', 'p.id')
                        ->join('detalles as d', 'dp.det_id', '=', 'd.id')
                        ->select('dc.id', 'componentes.id as comp_id', 'componentes.nombre', 'dc.umed_id')
                        ->where('d.id', '=', $det_id)
                        ->where('p.id', '=', $proc_id)
                        ->get();
        return response()->json($comp_proc_est);
                // SELECT cp.id, c.nombre
                // FROM componentes c
                // INNER JOIN detalle_componentes cp ON c.id = cp.comp_id
                // INNER JOIN procedimientos p ON cp.proc_id = p.id
                // INNER JOIN detalle_procedimientos dp ON p.id = dp.proc_id
                // INNER JOIN detalles d ON dp.det_id = d.id
                // WHERE d.id = 1
                // AND p.id = 5
    }
    public function getProcedimientoEstudio($id)
    {
        $proc_est = DB::table('procedimientos')
                    ->join('detalle_procedimientos as dp', 'dp.proc_id', '=', 'procedimientos.id')
                    ->join('detalles as d', 'dp.det_id', '=', 'd.id')
                    ->select('procedimientos.id')
                    ->where('d.id', '=', $id)
                    ->get();
        return response()->json($proc_est);
    }
}
