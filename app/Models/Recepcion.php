<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'est_id',
        'cli_id',
        'med_id',
        'emp_id',
        'estado',
        'observacion',
        'referencia',
    ];

    public function estudio()
    {
        return $this->belongsTo(Estudio::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
