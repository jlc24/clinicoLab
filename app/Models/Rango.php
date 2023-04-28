<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rango extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_inicial', 
        'valor_final',
        'referencia',
    ];

    public function detallecomponentes()
    {
        return $this->hasMany(DetalleComponente::class);
    }
}
