<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    protected $fillable = [
        'ca_id',
        'genero',
        'edad_inicial',
        'edad_final',
        'tiempo',
        'valor_inicial',
        'valor_final',
        'umed_id',
        'referencia'
    ];

    public function componenteaspecto()
    {
        return $this->belongsTo(ComponenteAspecto::class, 'ca_id');
    }
}
