<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Material;
use App\Models\Provider;
use App\Models\UMedida;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('material.index', [
            'materiales' => Material::all(),
            'medidas' => UMedida::all(),
            'proveedores' => Provider::all(),
            'categorias' => Categoria::all(),
        ]);
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
        if ($request->hasFile('mat_imagen')) {
            $request->validate([
                'mat_cod' => 'required|string|max:100',
                'mat_nombre' => 'required|string|max:255',
                'mat_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $material = Material::create([
                'mat_cod' => $request->input('mat_cod'),
                'mat_nombre' => $request->input('mat_nombre'),
                'mat_descripcion' => $request->input('mat_descripcion'),
                'mat_ventas' => '0',
                'mat_estado' => '0',
                'cat_id' => $request->input('cat_id'),
            ]);

            $imagen = $request->file('mat_imagen');
            $nombreArchivo = time().'_'.$imagen->getClientOriginalName();
            $rutaCarpetaDestino = 'imagenes/'.$request->cat_id.'/'.$material->id.'/';
            if (!is_dir($rutaCarpetaDestino)) {
                mkdir($rutaCarpetaDestino, 0777, true);
            }
            $imagen->move(public_path($rutaCarpetaDestino), $nombreArchivo);
            $rutaImagen = $rutaCarpetaDestino.$nombreArchivo;
        }else{
            $request->validate([
                'mat_cod' => 'required|string|max:100',
                'mat_nombre' => 'required|string|max:255',
            ]);

            $material = Material::create([
                'mat_cod' => $request->input('mat_cod'),
                'mat_nombre' => $request->input('mat_nombre'),
                'mat_descripcion' => $request->input('mat_descripcion'),
                'mat_ventas' => '0',
                'mat_estado' => '0',
                'cat_id' => $request->input('cat_id'),
            ]);

            $rutaImagen = null;
        }

        $materialImagen = Material::find($material->id);
        $materialImagen->mat_imagen = $rutaImagen;
        $materialImagen->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $material = Material::find($id);
        return response()->json($material);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('mat_imagen')) {
            $request->validate([
                'mat_cod' => 'required|string|max:100',
                'mat_nombre' => 'required|string|max:255',
                'mat_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $material = Material::find($id);
            $material->update([
                'mat_cod' => $request->input('mat_cod'),
                'mat_nombre' => $request->input('mat_nombre'),
                'mat_descripcion' => $request->input('mat_descripcion'),
                'cat_id' => $request->input('cat_id'),
            ]);
            $imagen = $request->file('mat_imagen');
            $nombreArchivo = time().'_'.$imagen->getClientOriginalName();
            $rutaCarpetaDestino = 'imagenes/'.$request->cat_id.'/'.$material->id.'/';
            if (!is_dir($rutaCarpetaDestino)) {
                mkdir($rutaCarpetaDestino, 0777, true);
            }
            $imagen->move(public_path($rutaCarpetaDestino), $nombreArchivo);
            $rutaImagen = $rutaCarpetaDestino.$nombreArchivo;
            $materialImagen = Material::find($material->id);
            $materialImagen->mat_imagen = $rutaImagen;
            $materialImagen->save();
        }else{
            $request->validate([
                'mat_cod' => 'required|string|max:100',
                'mat_nombre' => 'required|string|max:255'
            ]);

            $material = Material::find($id);
            $material->update([
                'mat_cod' => $request->input('mat_cod'),
                'mat_nombre' => $request->input('mat_nombre'),
                'mat_descripcion' => $request->input('mat_descripcion'),
                'cat_id' => $request->input('cat_id'),
            ]);
        }
    }

    public function updateMaterialEstado(Request $request, $id)
    {
        $material = Material::find($id);
        $material->mat_estado = $request->input('mat_estado');
        $material->save();
    }
    
    public function updateMaterialCompra(Request $request, $id)
    {
        $material = Material::find($id);
        $material->umed_id = $request->input('umed_id');
        $material->mat_cantidad = $request->input('mat_cantidad');
        $material->mat_precio_compra = $request->input('mat_precio_compra');
        $material->mat_precio_unitario = $request->input('mat_precio_unitario');
        $material->mat_ventas = '0';
        $material->comp_id = $request->input('comp_id');
        $material->save();

        $compras = Compra::find($request->input('comp_id'));
        $compras->comp_estado = '1';
        $compras->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        //
    }
}
