<?php

namespace Database\Seeders;

use App\Models\UMedida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medidas = [
            'Bs', 
            '$',
            '%',
            'm',
            'kg',
            'mol',
            's',
            'A',
            'K',
            'cd',
        ];
        foreach ($medidas as $medida ) {
            UMedida::create([
                'unidad' => $medida
            ]);
        }
    }
}
