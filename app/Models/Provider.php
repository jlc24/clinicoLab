<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'prov_nombre',
        'emp_id',
        'prov_nit',
        'prov_direccion',
        'prov_telefono',
        'prov_email',
        'prov_web',
        'prov_descripcion',
        'prov_notas',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'emp_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
