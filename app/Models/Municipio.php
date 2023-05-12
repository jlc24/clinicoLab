<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
}
