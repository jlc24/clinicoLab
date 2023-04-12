<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudio_id',
        'muestra_id',
        'recipiente_id',
        'indicacion_id',
    ];

    public function estudio()
    {
        return $this->belongsTo(Estudio::class);
    }

    public function muestra()
    {
        return $this->belongsTo(Muestra::class);
    }

    public function recipiente()
    {
        return $this->belongsTo(Recipiente::class);
    }

    public function indicacion()
    {
        return $this->belongsTo(Indication::class);
    }
    
    public function recepcions()
    {
        return $this->hasMany(Recepcion::class);
    }
}
