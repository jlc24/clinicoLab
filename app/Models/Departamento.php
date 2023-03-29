<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    public function municipio()
    {
        return $this->hasMany(Departamento::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
