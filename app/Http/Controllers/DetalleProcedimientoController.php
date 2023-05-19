<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use App\Models\DetalleProcedimiento;
use App\Models\DpComponente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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

        DB::statement("
            UPDATE detalle_procedimientos
            SET estado = 0
            WHERE det_id = $det_proc->det_id
                AND id != $id"
        );
    }

    public function getProcedimientoEstudio($id)
    {
        $proc_est = DB::table('procedimientos as p')
                    ->join('detalle_procedimientos as dp', 'dp.proc_id', '=', 'p.id')
                    ->join('detalles as d', 'dp.det_id', '=', 'd.id')
                    ->join('dp_componentes as dpc', 'dp.id', '=', 'dpc.dp_id')
                    ->select('p.*', 'dp.id as dp_id')
                    ->where([['d.id', '=', $id], ['dp.estado', '=', '1']])
                    ->distinct()
                    ->get();
        return response()->json($proc_est);
    }

    public function getComponenteEstudio($id)
    {
        $comp_est = DB::table('detalle_procedimientos as dp')
                    ->join('detalles as d', 'dp.det_id', '=', 'd.id')
                    ->select('dp.id')
                    ->where('d.id', '=', $id)
                    ->where('estado', '=', '1')
                    ->get();
        return response()->json($comp_est);
    }

    public function getComponenteDp($id)
    {
        $dp_comp = DB::table('dp_componentes as dpc')
                    ->join('componentes as c', 'dpc.comp_id', '=', 'c.id')
                    ->select('dpc.id', 'c.nombre')
                    ->where('dpc.dp_id', '=', $id)
                    ->get();
        return response()->json($dp_comp);
    }

    public function updateDetalleComponente(Request $request)
    {
        $request->validate([
            'det_id' => 'integer',
            'comp_id' => 'integer',
            'comp_nombre' => [ 'max:100',
                            Rule::unique('componentes', 'nombre'),
                            'regex:/^[a-zA-Z\s]+$/'
                        ],
        ]);
        
        if ($request->input('comp_id') == "0") {
            $componente = Componente::create([
                'nombre' => $request->input('comp_nombre')
            ]);

            DpComponente::create([
                'dp_id' => $request->input('det_id'),
                'comp_id' => $componente->id
            ]);
        }else{
            DpComponente::create([
                'dp_id' => $request->input('det_id'),
                'comp_id' => $request->input('comp_id')
            ]);
        }
    }
}
