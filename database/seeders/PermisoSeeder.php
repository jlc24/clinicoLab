<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Acceso a Usuarios del Sistema',
            'Acceso a Permisos del Sistema',
            'Acceso a Registro de Pacientes',
            'Acceso a Modificacion de Pacientes',
            'Acceso a Registro de Medicos',
            'Acceso a Modificación de Médicos',
            'Acceso a Catálogos del sistema',
            'Acceso a Registro de Estudios',
            'Acceso a Estudios',
            'Acceso a Materiales',
            'Acceso a Componentes',
            'Acceso a Recipientes',
            'Acceso a Muestras',
            'Acceso a Indicaciones',
            'Acceso a Proveedores',
            'Acceso a Categorías',
            'Acceso a Capturas',
            'Acceso a Recepción',
            'Acceso a Historial Recepción',
            'Acceso a Resultados',
            'Acceso a Herramientas',
            'Acceso a Cajas',
            'Acceso a Facturas',
        ];

        foreach ($permisos as $permiso ) {
            Permiso::create([
                'permiso' => $permiso
            ]);
        }
    }
}
