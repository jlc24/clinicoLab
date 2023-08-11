<?php

namespace App\Http\Controllers;

use App\Models\DetalleMaterial;
use App\Models\UMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleMaterialController extends Controller
{
    public function getMaterialEstudio($id)
    {
        $mat_est = DB::table('detalle_materials as dm')
                        ->join('materials as m', 'dm.mat_id', '=', 'm.id')
                        ->join('u_medidas as um', 'um.id', '=', 'm.umed_id')
                        ->select('dm.*', 'm.mat_nombre', 'm.mat_precio_compra', 'm.mat_cantidad', 'um.unidad')
                        ->where('dm.ca_id', '=', $id)
                        ->where('m.mat_estado', '=', '1')
                        ->get();
        
        return response()->json($mat_est);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mat_id' => 'integer',
            'ca_id' => 'integer'
        ]);

        DetalleMaterial::create([
            'ca_id' => $request->input('ca_id'),
            'mat_id' => $request->input('mat_id'),
            'umed_id' => $request->input('umed_id')
        ]);
    }

    public function update(Request $request, $id)
    {
        $det_mat = DetalleMaterial::find($id);
        $det_mat->update([
            'mat_id' => $request->input('mat_id'),
            'ca_id' => $request->input('det_id'),
            'cantidad' => $request->input('cantidad'),
            'umed_id' => $request->input('umed_id'),
            'precio_total' => $request->input('precio_total')
        ]);
    }

    public function destroy($id)
    {
        $det_mat = DetalleMaterial::find($id);
        $det_mat->delete();
    }
}
