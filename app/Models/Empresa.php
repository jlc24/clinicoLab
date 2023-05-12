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
        'emp_convenio'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'dep_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'mun_id');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}
