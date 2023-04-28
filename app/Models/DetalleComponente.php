<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleComponente extends Model
{
    use HasFactory;

    protected $fillable = [
        'proc_id',
        'comp_id',
        'umed_id',
        'tabla_referencia',
        'tabla_id',
        'sexoedad_id',
        'rango_id',
        'cual_id',
        'texto_id',
    ];

    public function procedimiento()
    {
        return $this->belongsTo(Procedimiento::class, 'proc_id');
    }

    public function componente()
    {
        return $this->belongsTo(Componente::class, 'comp_id');
    }

    public function umedida()
    {
        return $this->belongsTo(UMedida::class, 'umed_id');
    }

    public function tabla()
    {
        return $this->belongsTo(Tabla::class, 'tabla_id');
    }

    public function sexoedade()
    {
        return $this->belongsTo(Sexoedade::class, 'sexoedad_id');
    }

    public function rango()
    {
        return $this->belongsTo(Rango::class, 'rango_id');
    }

    public function cualitativo()
    {
        return $this->belongsTo(Cualitativo::class, 'cual_id');
    }

    public function texto()
    {
        return $this->belongsTo(Texto::class, 'texto_id');
    }
}
