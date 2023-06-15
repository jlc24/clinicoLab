<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Permiso;
use App\Models\PermisoUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::all();
        $countmed = Medico::count();
        $medicos = Medico::all();
        return view('medico.index',[
            'medicos' => $medicos, 
            'departamentos' => $departamentos,
            'municipios' => Municipio::all(), 
            'countmed' => $countmed,
            'permisos' => Permiso::all()
        ]);
    }

    public function countMedicos()
    {
        $medicos = Medico::count();
        return response()->json($medicos);
    }

    public function getMedico($id)
    {
        $medico = Medico::find($id);
        return response()->json($medico);
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
            'med_cod' => 'required|unique:medicos|max:10', 
            'med_nombre' => 'required|max:20',
            'med_apellido_pat' => 'required|max:50',
            'med_apellido_mat' => 'max:50',
            'med_ci_nit' => 'required',
            'med_ci_nit_exp' => 'max:10',
            'med_genero' => 'required|max:10', 
            'med_email' => 'required|email|max:255',
            'med_direccion' => 'max:255',
            'med_celular' => 'required|max:15',
            'med_especialidad' => 'required|max:50',
            'med_usuario' => 'required|max:10',
            'med_password' => 'required',
        ]);

        // dd($request->all());
        $user = User::create([
            'user' => $request->input('med_usuario'),
            'email' => $request->input('med_email'),
            'password' => Hash::make($request->input('med_password')),
            'estado' => $request->input('med_estado'),
            'rol' => $request->input('med_rol')
        ]);

        Medico::create([
            'med_cod' => $request->input('med_cod'),
            'med_nombre' => $request->input('med_nombre'),
            'med_apellido_pat' => $request->input('med_apellido_pat'),
            'med_apellido_mat' => $request->input('med_apellido_mat'),
            'med_ci_nit' => $request->input('med_ci_nit'),
            'med_exp_ci' => $request->input('med_ci_nit_exp'),
            'med_genero' => $request->input('med_genero'),
            'med_correo' => $request->input('med_email'),
            'med_celular' => $request->input('med_celular'),
            'med_direccion' => $request->input('med_direccion'),
            'med_especialidad' => $request->input('med_especialidad'),
            'med_usuario' => $request->input('med_usuario'),
            'med_password' => $request->input('med_password'),
            'dep_id' => $request->input('med_departamento'),
            'mun_id' => $request->input('med_municipio'),
            'user_id' => $user->id
        ]);

        $permisos = Permiso::all();
        foreach ($permisos as $permiso ) {
            PermisoUser::create([
                'user_id' => $user->id,
                'permiso_id' => $permiso->id,
                'estado' => 0
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medico $medico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medico $medico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'med_nombre_update' => 'required|max:20',
            'med_apellido_pat_update' => 'required|max:50',
            'med_apellido_mat_update' => 'max:50',
            'med_ci_nit_update' => 'required',
            'med_ci_nit_exp_update' => 'max:10',
            'med_genero_update' => 'required|max:10', 
            'med_direccion_update' => 'max:255',
            'med_celular_update' => 'required|max:15',
            'med_especialidad_update' => 'required|max:50',
        ]);
        $medico = Medico::find($id);
        $medico->update([
            'med_cod' => $request->input('med_cod_update'),
            'med_nombre' => $request->input('med_nombre_update'),
            'med_apellido_pat' => $request->input('med_apellido_pat_update'),
            'med_apellido_mat' => $request->input('med_apellido_mat_update'),
            'med_ci_nit' => $request->input('med_ci_nit_update'),
            'med_exp_ci' => $request->input('med_ci_nit_exp_update'),
            'med_genero' => $request->input('med_genero_update'),
            'med_celular' => $request->input('med_celular_update'),
            'med_direccion' => $request->input('med_direccion_update'),
            'med_especialidad' => $request->input('med_especialidad_update'),
        ]);
        
        return redirect()->route('medico')->with('success', 'El registro se ha modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico)
    {
        //
    }
}
