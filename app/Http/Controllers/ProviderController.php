<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proveedor.index',[
            'proveedores' => Provider::all(),
            'empresas' => Empresa::all(),
        ]);
    }

    public function getNITEmpresa($id)
    {
        $nit = Empresa::find($id);
        return response()->json($nit);
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
            'nombre' => 'required|string|max:255',
        ]);

        Provider::create([
            'prov_nombre' => $request->input('nombre'),
            'emp_id' => $request->input('emp_id'),
            'prov_nit' => $request->input('nit'),
            'prov_direccion' => $request->input('direccion'),
            'prov_telefono' => $request->input('telefono'),
            'prov_email' => $request->input('email'),
            'prov_web' => $request->input('web'),
            'prov_descripcion' => $request->input('descripcion'),
            'prov_notas' => $request->input('notas'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $provider = Provider::find($id);
        return response()->json($provider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $provider = Provider::find($id);
        $provider->nombre = $request->input('nombre');
        $provider->emp_id = $request->input('emp_id');
        $provider->nit = $request->input('nit');
        $provider->direccion = $request->input('direccion');
        $provider->telefono = $request->input('telefono');
        $provider->email = $request->input('email');
        $provider->web = $request->input('web');
        $provider->descripcion = $request->input('descripcion');
        $provider->notas = $request->input('notas');
        $provider->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
    }
}
