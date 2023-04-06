<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nit',
        'direccion', 
        'pais',
        'departamento',
        'municipio',
        'telefono',
        'web', 
        'logo', 
    ];
    
}
