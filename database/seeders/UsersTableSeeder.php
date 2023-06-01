<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'user' => 'Administrador',
            'email' => 'adm12345@gmail.com',
            'password' => Hash::make('adm12345mda'),
            'estado' => 1,
            'rol' => 'admin'
        ]);
    }
}
