<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexoedade extends Model
{
    use HasFactory;

    protected $fillable = [
        'genero',
        'edad_inicial',
        'edad_final',
        'tiempo',
        'valor_inicial',
        'valor_final',
        'referencia',
    ];

    public function detallecomponentes()
    {
        return $this->hasMany(DetalleComponente::class);
    }
}
