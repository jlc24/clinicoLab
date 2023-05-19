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
            'comp_ventas' => '0',
            'comp_estado' => '3'
        ]);

        
    }

    public function updateCompEstado($id)
    {
        // comp_estado =>   1 = en uso
        //                  2 = en espera
        //                  3 = en reserva
        //                  4 = agotado
        //                  5 = expirado

        $fechaActual = date("Y-m-d");
        $compras = Compra::where([
                                ['mat_id', '=', $id],
                                ['comp_vencimiento', '>=', $fechaActual],
                                ['comp_estado', '!=', '4'],
                                ['comp_estado', '!=', '5']
                            ])
                            ->orderBy('comp_vencimiento', 'asc')
                            ->get();

        /// Verificar el valor del primer dato
        if ($compras[0]->comp_estado == 3) {
            // Si el primer dato es 3, modificar el primer registro a 2
            $compras[0]->comp_estado = 2;

            for ($i = 1; $i < count($compras); $i++) {
                $compras[$i]->comp_estado = 3;
            }
        } elseif ($compras[0]->comp_estado == 1) {
            // Si el primer dato es 1, modificar el segundo registro a 2
            $compras[1]->comp_estado = 2;

            for ($i = 2; $i < count($compras); $i++) {
                $compras[$i]->comp_estado = 3;
            }
        }

        // Modificar los demás registros a 3
        // for ($i = 1; $i < count($compras); $i++) {
        //     $compras[$i]->comp_estado = 3;
        // }

        // Guardar los cambios en la base de datos
        foreach ($compras as $compra) {
            $compra->save();
        }

        return response()->json($compras);
    }

    public function getComprasMaterial($id)
    {
        $fechaActual = date("Y-m-d");
        $compra = Compra::select('id', 'mat_id', 'comp_cantidad', 'comp_vencimiento', 'comp_estado', 'umed_id', 'comp_precio_compra', 'comp_precio_unitario', 'comp_ventas')
                        ->where([
                            ['mat_id', '=', $id],
                            ['comp_vencimiento', '>=', $fechaActual],
                            ['comp_estado', '!=', '4'],
                            ['comp_estado', '!=', '5']
                        ])
                        ->orderBy('comp_vencimiento', 'asc')
                        ->get();
        
        $umed_ids = $compra->pluck('umed_id')->toArray();

        // Obtenemos los valores de unidad de medida correspondientes
        $unidades = [];
        foreach ($umed_ids as $umed_id) {
            $unidad = UMedida::find($umed_id);
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

    public function updateVencimientoCompra($id)
    {
        $fechaActual = date("Y-m-d");
        $compras = Compra::where([
                                ['mat_id', '=', $id],
                                ['comp_vencimiento', '<', $fechaActual]
                            ])
                            ->orderBy('comp_vencimiento', 'asc')
                            ->get();
        foreach ($compras as $compra) {
            $compra->comp_estado = '5';
            $compra->save();
        }
    }
}
