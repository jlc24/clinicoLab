<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->rol == 'usuario' || $user->rol == 'admin') {
            $usuario = DB::table('usuarios as u')
                        ->select('u.id as id', 'u.usuario_ci_nit as user_ci', 'u.usuario_direccion as user_dir', 'u.usuario_usuario as user_user', 'u.usuario_correo as user_correo', 'u.usuario_password as user_pass',
                        DB::raw("CONCAT(u.usuario_nombre, ' ', 
                                        u.usuario_apellido_pat, ' ', 
                                        IFNULL(u.usuario_apellido_mat,'')) AS nombre"), )
                        ->where('u.user_id', '=', $user->id)
                        ->first();
        }else if ($user->rol == 'medico' ){
            $usuario = DB::table('medicos as m')
                        ->select('m.id as id', 'm.med_ci_nit as user_ci', 'm.med_direccion as user_dir', 'm.med_usuario as user_user', 'm.med_correo as user_correo', 'm.med_password as user_pass',
                        DB::raw("CONCAT(m.med_nombre, ' ', 
                                        m.med_apellido_pat, ' ', 
                                        IFNULL(m.med_apellido_mat,'')) AS nombre"), )
                        ->first();
        }
        return view('perfil.index', [
            'usuario' => $usuario
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
