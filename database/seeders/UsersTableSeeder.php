<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\PermisoUser;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'user' => 'Administrador',
            'email' => 'adm12345@gmail.com',
            'password' => Hash::make('adm12345mda'),
            'estado' => 1,
            'rol' => 'admin'
        ]);

        Usuario::create([
            'usuario_cod' => 'ADM',
            'usuario_nombre' => 'ADMINISTRADOR',
            'usuario_apellido_pat' => 'ADMINISTRADOR',
            'usuario_ci_nit' => '0000000',
            'usuario_exp_ci' => 'Oruro',
            'usuario_genero' => 'ADMIN',
            'usuario_correo' => $user->email,
            'usuario_direccion' => 'Oruro',
            'user_id' => $user->id,
            'usuario_usuario' => $user->user,
            'usuario_password' => $user->password,
            'usuario_departamento' => 'Oruro',
            'usuario_municipio' => 'Oruro',
        ]);

        $permisos = Permiso::all();
        foreach ($permisos as $permiso ) {
            PermisoUser::create([
                'user_id' => $user->id,
                'permiso_id' => $permiso->id,
                'estado' => 1
            ]);
        }
    }
}
