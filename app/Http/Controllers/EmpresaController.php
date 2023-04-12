<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Municipio;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('empresa.index',[
            'empresas' => Empresa::all(),
            'departamentos' => Departamento::all(),
            'municipios' => Municipio::all(),
            'countemp' => Empresa::count(),
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
            'emp_cod' => 'required|unique:empresas|max:10',
            'emp_nombre' => 'required|max:50',
            'emp_nit' => 'max:20',
            'emp_direccion' => 'required|max:255',
        ]);

        Empresa::create([
            'emp_cod' => $request->input('emp_cod'),
            'emp_nombre' => $request->input('emp_nombre'),
            'emp_nit' => $request->input('emp_nit'),
            'emp_direccion' => $request->input('emp_direccion'),
            'dep_id' => $request->input('emp_departamento'),
            'mun_id' => $request->input('emp_municipio'),
        ]);

        return redirect()->route('empresa')->with('success', 'El registro se ha creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'emp_cod_update' => 'required|max:10|unique:empresas,emp_cod,'.$id,
            'emp_nombre_update' => 'required|max:50',
            'emp_nit_update' => 'max:20',
            'emp_direccion_update' => 'required|max:255',
        ]);

        $empresa = Empresa::find($id);
        $empresa->emp_cod = $request->input('emp_cod_update');
        $empresa->emp_nombre = $request->input('emp_nombre_update');
        $empresa->emp_nit = $request->input('emp_nit_update');
        $empresa->emp_direccion = $request->input('emp_direccion_update');
        $empresa->dep_id = $request->input('cli_departamento_update');
        $empresa->mun_id = $request->input('cli_municipio_update');
        $empresa->save();

        return redirect()->route('empresa')->with('success', 'El registro se ha modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
