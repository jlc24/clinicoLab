<?php

namespace Database\Seeders;

use App\Models\Banco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bancos = [
            'BANCO DE CREDITO (BCP)',
            'BANCO BISA',
            'BANCO DE LA NACION ARGENTINA',
            'BANCO FORTALEZA',
            'BANCO GANADERO',
            'BANCO SOLIDARIO',
            'BANCO FIE',
            'BANCO MERCANTIL SANTA CRUZ',
            'BANCO NACIONAL DE BOLIVIA',
            'BANCO ECONOMICO',
            'BANCO UNION',
            'BANCO CENTRAL DE BOLIVIA',
            'BANCO DE DESARROLLO PRODUCTIVO',
            'BANCO PYME DE LA COMUNIDAD',
            'BANCO PYME ECOFUTURO',
            'LA PRIMERA - EFV',
            'LA PROMOTORA - EFV',
            'EL PROGRESO ENTIDAD FINANCIERA DE VIVIENDA',
            'EL PROGRESO - EFV',
            'PRO MUJER IFD',
            'FONDECO IFD',
            'SEMBRAR SARTAWI - IFD',
            'IMPRO IFD',
            'CRECER IFD',
            'CIDRE IFD',
            'IDEPRO IFD',
            'FUNDACION PRO MUJER IFD',
            'DIACONIA IFD',
        ];

        foreach ($bancos as $banco ) {
            Banco::create([
                'nombre' =>  $banco
            ]);
        }
    }
}
