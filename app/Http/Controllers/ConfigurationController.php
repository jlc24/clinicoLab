<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Configuration::all()->first();
        return view('configuracion.index', [
            'datos' => $datos,
            'departamentos' => Departamento::all(),
            'municipios' => Municipio::all(),
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
        $request->validate([
            'nombre' => 'required|string|max:50',
            'nit' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'pais' => 'required|string|max:10',
            'departamento' => 'required|string|max:20',
            'municipio' => 'required|string|max:50',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|max:255',
            'web' => 'required|string|max:255',
        ]);

        Configuration::create([
            'nombre' => $request->input('nombre'),
            'nit' => $request->input('nit'),
            'direccion' => $request->input('direccion'),
            'pais' => $request->input('pais'),
            'departamento' => $request->input('departamento'),
            'municipio' => $request->input('municipio'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'web' => $request->input('web')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'nit' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'pais' => 'required|string|max:10',
            'departamento' => 'required|string|max:20',
            'municipio' => 'required|string|max:50',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|max:255',
            'web' => 'required|string|max:255',
        ]);
        $config = Configuration::find($id);
        $config->update([
            'nombre' => $request->input('nombre'),
            'nit' => $request->input('nit'),
            'direccion' => $request->input('direccion'),
            'pais' => $request->input('pais'),
            'departamento' => $request->input('departamento'),
            'municipio' => $request->input('municipio'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'web' => $request->input('web')
        ]);
    }

    public function updateLogo(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nombreArchivo = time().'_'.$file->getClientOriginalName();
            $rutaCarpetaDestino = 'imagenes/logo/';
            if (!is_dir($rutaCarpetaDestino)) {
                mkdir($rutaCarpetaDestino, 0777, true);
            }
            $file->move(public_path($rutaCarpetaDestino), $nombreArchivo);
            $rutaImagen = $rutaCarpetaDestino.$nombreArchivo;
            
            $config = Configuration::find($id);
            $config->update([
                'logo' => $rutaImagen
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}
