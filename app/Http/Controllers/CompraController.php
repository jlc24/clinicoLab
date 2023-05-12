<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Material;
use App\Models\UMedida;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    //
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'mat_id' => 'integer',
            'comp_fecha_elaboracion' => 'date',
            'comp_fecha_vencimiento' => 'date',
            'umed_id' => 'integer',
            'comp_cantidad' => 'integer',
            'comp_precio_compra' => 'decimal:2',
            'comp_precio_unitario' => 'decimal:2',
            'comp_tipo' => 'string|max:50',
            'comp_observacion' => 'string|max:255'
        ]);

        Compra::create([
            'mat_id' => $request->input('mat_id'),
            'comp_elaboracion' => $request->input('comp_elaboracion'),
            'comp_vencimiento' => $request->input('comp_vencimiento'),
            'umed_id' => $request->input('umed_id'),
            'comp_cantidad' => $request->input('comp_cantidad'),
            'comp_precio_compra' => $request->input('comp_precio_compra'),
            'comp_precio_unitario' => $request->input('comp_precio_unitario'),
            'comp_tipo' => $request->input('comp_tipo'),
            'prov_id' => $request->input('prov_id'),
            'comp_observacion' => $request->input('comp_observacion'),
            'comp_estado' => $request->input('comp_estado')
        ]);
    }

    public function getComprasMaterial($id)
    {
        $compra = Compra::select('id', 'mat_id', 'comp_cantidad', 'comp_precio_compra', 'comp_precio_unitario', 'umed_id')
                        ->where('mat_id', '=', $id)
                        ->get();
        
        $umed_ids = $compra->pluck('umed_id')->toArray();

        // Obtenemos los valores de unidad de medida correspondientes
        $unidades = [];
        foreach ($umed_ids as $id) {
            $unidad = UMedida::find($id);
            if (!$unidad) {
                $unidad = '';
            } else {
                $unidad = $unidad->unidad;
            }
            $unidades[] = $unidad;
        }

        // Añadimos los valores de unidad de medida a cada objeto de compra
        foreach ($compra as $key => $value) {
            $value->unidad = $unidades[$key];
            $material = Material::where('comp_id', $value->id)->first();
            if ($material) {
                $value->inMaterial = 1;
            } else {
                $value->inMaterial = 0;
            }
        }
        return response()->json($compra);
    }

    public function edit($id)
    {
        $compra = Compra::where('id', '=', $id)->latest()->first();
        return response()->json($compra);
    }

    public function update(Request $request, $id)
    {
        //
    }
}
