<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configurations')->insert([
            'nombre' => 'ClinicoLab',
            'nit' => '12345678',
            'direccion' => '6 DE OCTUBRE ENTRE CARO Y MONTECINOS #4521',
            'pais' => 'BOLIVIA',
            'departamento' => 'Oruro',
            'municipio' => 'Oruro',
            'telefono' => '68293415',
            'web' => 'www.clinicolab.com',
            'logo' => '',
        ]);
    }
}
