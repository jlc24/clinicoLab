<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::all();
        $clientes = Cliente::all();
        $countpac = Cliente::count();
        $password = Str::random(3);
        return view('cliente.index', [
            'departamentos' => $departamentos, 
            'clientes' => $clientes,
            'countpac' => $countpac,
            'password' => $password
        ]);
    }

    public function datos($id)
    {
        $datos = Municipio::where('dep_id', $id)->get();
        return response()->json($datos);
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
            'cli_cod' => 'required|unique:clientes|max:10',
            'cli_nombre' => 'required|max:10',
            'cli_apellido_pat' => 'required|max:20',
            'cli_apellido_mat' => 'max:20',
            'cli_ci_nit' => 'required',
            'cli_ci_nit_exp' => 'required|max:10',
            'cli_fec_nac' => 'required|date',
            'cli_genero' => 'required|max:10',
            'cli_email' => 'nullable|max:255',
            'cli_direccion' => 'max:255',
            'cli_celular' => 'required|max:15',
            'cli_departamento' => 'required',
            'cli_municipio' => 'required',
        ]);

        $cliente = new Cliente();
        $cliente->cli_cod = $request->input('cli_cod');
        $cliente->cli_nombre = $request->input('cli_nombre');
        $cliente->cli_apellido_pat = $request->input('cli_apellido_pat');
        $cliente->cli_apellido_mat = $request->input('cli_apellido_mat');
        $cliente->cli_ci_nit = $request->input('cli_ci_nit');
        $cliente->cli_ci_exp = $request->input('cli_ci_nit_exp');
        $cliente->cli_fec_nac = $request->input('cli_fec_nac');
        $cliente->cli_genero = $request->input('cli_genero');
        $cliente->cli_correo = $request->input('cli_correo');
        $cliente->cli_direccion = $request->input('cli_direccion');
        $cliente->cli_celular = $request->input('cli_celular');
        $cliente->dep_id = $request->input('cli_departamento');
        $cliente->mun_id = $request->input('cli_municipio');
        $cliente->save();

        return redirect()->route('cliente')->with('success', 'El registro se ha creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
