<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_cod',
        'emp_nombre', 
        'emp_nit', 
        'emp_direccion', 
        'dep_id',
        'mun_id',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function recepcions()
    {
        return $this->hasMany(Recepcion::class);
    }
}
