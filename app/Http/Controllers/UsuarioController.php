<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Medico;
use App\Models\Municipio;
use App\Models\Permiso;
use App\Models\PermisoUser;
use App\Models\User;
use App\Models\Usuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', [
            'usuarios' => Usuario::all(),
            'countuser' => Usuario::count(),
            'users' => User::all(),
            'departamentos' => Departamento::all(),
            'municipios' => Municipio::all(),
            'medicos' => Medico::all(),
            'permisos' => Permiso::all()
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
            'usuario_cod' => 'required|max:50',
            'usuario_nombre' => 'required|max:50', 
            'usuario_apellido_pat' => 'required|max:50', 
            'usuario_apellido_mat' => 'max:50', 
            'usuario_ci_nit' => 'required|max:10', 
            'usuario_ci_nit_exp' => 'required|max:10', 
            'usuario_fec_nac' => 'date',
            'usuario_genero' => 'required|max:10', 
            'usuario_email' => 'required|max:255',
            'usuario_direccion' => 'required|max:255',
            'usuario_celular' => 'required|max:15', 
            'usuario_usuario' => 'required|max:255', 
            'usuario_password' => 'required|max:255',
            'usuario_departamento' => 'required|max:50',
            'usuario_municipio' => 'required|max:50'
        ]);

        $user = User::create([
            'user' => $request->input('usuario_usuario'),
            'email' => $request->input('usuario_email'),
            'password' => Hash::make($request->input('usuario_password')),
            'estado' => '0',
            'rol' => $request->input('usuario_rol')
        ]);
        Usuario::create([
            'usuario_cod' => $request->input('usuario_cod'),
            'usuario_nombre' => $request->input('usuario_nombre'),
            'usuario_apellido_pat' => $request->input('usuario_apellido_pat'),
            'usuario_apellido_mat' => $request->input('usuario_apellido_mat'),
            'usuario_ci_nit' => $request->input('usuario_ci_nit'),
            'usuario_exp_ci' => $request->input('usuario_ci_nit_exp'),
            'usuario_fec_nac' => $request->input('usuario_fec_nac'),
            'usuario_genero' => $request->input('usuario_genero'),
            'usuario_correo' => $request->input('usuario_email'),
            'usuario_direccion' => $request->input('usuario_direccion'),
            'usuario_celular' => $request->input('usuario_celular'),
            'usuario_usuario' => $request->input('usuario_usuario'),
            'usuario_password' => $request->input('usuario_password'),
            'usuario_departamento' => $request->input('usuario_departamento'),
            'usuario_municipio' => $request->input('usuario_municipio'),
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
    public function show(Usuario $usuario)
    {
        //
    }

    public function updateActivarUserEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|integer'
        ]);
        
        $usuario = Usuario::find($id);
        $user = User::find($usuario->user_id);
        $user->estado = '1';
        $user->save();
    }
    public function updateDesactivarUserEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|integer'
        ]);
        
        $usuario = Usuario::find($id);
        $user = User::find($usuario->user_id);
        $user->estado = '0';
        $user->save();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuarios = DB::table('usuarios as u')
                        ->join('users as us', 'us.id', '=', 'u.user_id')
                        ->select('u.*', 'us.rol as usuario_rol', 'us.estado')
                        ->where('u.id', '=', $id)
                        ->get();
        foreach ($usuarios as $usuario ) {
            $fecha_nac = new DateTime($usuario->usuario_fec_nac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nac)->y;
            $usuario->usuario_edad = $edad;

            $espanol = setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es');
            $fechaNacimiento = new DateTime($usuario->usuario_fec_nac);
            $usuario->fecha_nacimiento = strftime('%e de %B de %Y', $fechaNacimiento->getTimestamp());
        }
        return response()->json($usuarios);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
