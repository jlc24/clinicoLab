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
        'precio'.
        'umed_id',
        'tipo'
    ];

    public function estudio()
    {
        return $this->belongsTo(Estudio::class, 'estudio_id');
    }

    public function muestra()
    {
        return $this->belongsTo(Muestra::class, 'muestra_id');
    }

    public function recipiente()
    {
        return $this->belongsTo(Recipiente::class, 'recipiente_id');
    }

    public function indicacion()
    {
        return $this->belongsTo(Indication::class, 'indicacion_id');
    }

    public function umedida()
    {
        return $this->belongsTo(UMedida::class, 'umed_id');
    }
    
    public function recepcions()
    {
        return $this->hasMany(Recepcion::class);
    }

    public function detalleprocedimientos()
    {
        return $this->hasMany(DetalleProcedimiento::class);
    }

    public function detallematerials()
    {
        return $this->hasMany(DetalleMaterial::class);
    }
}
