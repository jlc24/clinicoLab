<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    use HasFactory;

    protected $fillable = [
        'est_cod',
        'est_nombre',
        'est_descripcion',
        'grupo_id',
        'subgrupo_id',
        'est_precio',
        'umed_id',
        'est_moneda'
    ];

    public function umedida()
    {
        return $this->belongsTo(UMedida::class, 'umed_id');
    }

    public function detalles()
    {
        return $this->hasMany(Detalle::class);
    }
}
