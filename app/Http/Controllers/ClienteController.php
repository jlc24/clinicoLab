<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cliente.index', [
            'departamentos' => Departamento::all(), 
            'clientes' => Cliente::all(),
            'countpac' => Cliente::count(),
            'municipios' => Municipio::all(),
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
            'cli_email' => 'required|email|max:255',
            'cli_direccion' => 'max:255',
            'cli_celular' => 'required|max:15',
            'cli_departamento' => 'required',
            'cli_municipio' => 'required',
            'cli_usuario' => 'required|max:10',
            'cli_password' => 'required',
            'cli_estado' => 'required',
            'cli_rol' => 'required'
        ]);
        // dd($request->all());

        
        $user = User::create([
            'user' => $request->input('cli_usuario'),
            'email' => $request->input('cli_email'),
            'password' => Hash::make($request->input('cli_password')),
            'estado' => $request->input('cli_estado'),
            'rol' => $request->input('cli_rol')
        ]);
        
        // Crear registro de cliente y asociarlo con el usuario creado anteriormente
        Cliente::create([
            'cli_cod' => $request->input('cli_cod'),
            'cli_nombre' => $request->input('cli_nombre'),
            'cli_apellido_pat' => $request->input('cli_apellido_pat'),
            'cli_apellido_mat' => $request->input('cli_apellido_mat'),
            'cli_ci_nit' => $request->input('cli_ci_nit'),
            'cli_exp_ci' => $request->input('cli_ci_nit_exp'),
            'cli_fec_nac' => $request->input('cli_fec_nac'),
            'cli_genero' => $request->input('cli_genero'),
            'cli_correo' => $request->input('cli_email'),
            'cli_direccion' => $request->input('cli_direccion'),
            'cli_celular' => $request->input('cli_celular'),
            'cli_usuario' => $request->input('cli_usuario'),
            'cli_password' => $request->input('cli_password'),
            'dep_id' => $request->input('cli_departamento'),
            'mun_id' => $request->input('cli_municipio'),
            'user_id' => $user->id
        ]);
        

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
    public function edit($id)
    {
        $clientes = Cliente::find($id);
        $departamentos = Departamento::all();
        $municipios = Municipio::all();
        //return $datos;
        return view('cliente.modal.modal_modificar_cliente', [
            'clientes' => $clientes,
            'departamentos' => $departamentos,
            'municipios' => $municipios
        ]);
        $clientes = Cliente::where('id', $id)->get();
        return response()->json($clientes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'cli_nombre' => 'required|max:10',
            'cli_apellido_pat' => 'required|max:20',
            'cli_apellido_mat' => 'max:20',
            'cli_ci_nit' => 'required',
            'cli_ci_nit_exp' => 'required|max:10',
            'cli_fec_nac' => 'required|date',
            'cli_genero' => 'required|max:10',
            'cli_email' => 'required|email|max:255',
            'cli_direccion' => 'max:255',
            'cli_celular' => 'required|max:15',
            'cli_departamento' => 'required',
            'cli_municipio' => 'required',
            'cli_usuario' => 'required|max:10',
            'cli_password' => 'required',
            'cli_estado' => 'required',
            'cli_rol' => 'required'
        ]);
        // dd($request->all());

        $model = User::find($id); // asumiendo que tienes el id del registro a actualizar

        $model->update([
            'user' => $request->input('cli_usuario'),
            'email' => $request->input('cli_email'),
            'password' => Hash::make($request->input('cli_password')),
            'estado' => $request->input('cli_estado'),
            'rol' => $request->input('cli_rol')
        ]);

        // Actualizar el registro correspondiente en la tabla Cliente
        $cliente = Cliente::where('user_id', '=', $id)->first();
        $cliente->update([
            'cli_cod' => $request->input('cli_cod'),
            'cli_nombre' => $request->input('cli_nombre'),
            'cli_apellido_pat' => $request->input('cli_apellido_pat'),
            'cli_apellido_mat' => $request->input('cli_apellido_mat'),
            'cli_ci_nit' => $request->input('cli_ci_nit'),
            'cli_exp_ci' => $request->input('cli_ci_nit_exp'),
            'cli_fec_nac' => $request->input('cli_fec_nac'),
            'cli_genero' => $request->input('cli_genero'),
            'cli_correo' => $request->input('cli_email'),
            'cli_direccion' => $request->input('cli_direccion'),
            'cli_celular' => $request->input('cli_celular'),
            'cli_usuario' => $request->input('cli_usuario'),
            'cli_password' => $request->input('cli_password'),
            'dep_id' => $request->input('cli_departamento'),
            'mun_id' => $request->input('cli_municipio')
        ]);

        return redirect()->route('cliente')->with('success', 'El registro se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
