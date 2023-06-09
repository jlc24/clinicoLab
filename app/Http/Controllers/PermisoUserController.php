<?php

namespace App\Http\Controllers;

use App\Models\PermisoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermisoUserController extends Controller
{
    

    public function getPermisosUser($id)
    {
        $permisos = DB::table('permiso_users as pu')
                        ->join('permisos as p', 'p.id', '=', 'pu.permiso_id')
                        ->join('users as u', 'u.id', '=', 'pu.user_id')
                        ->select('pu.id', 'p.permiso', 'pu.estado')
                        ->where('user_id', '=', $id)
                        ->get();
        return response()->json($permisos);
    }
    public function updatePermiso(Request $request, $id)
    {
        $request->validate([
            'estado' => ['required', 'integer', Rule::in([0,1])]
        ]);

        $permiso = PermisoUser::find($id);
        $permiso->estado = $request->input('estado');
        $permiso->save();
    }
}
