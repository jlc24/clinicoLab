<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'fac_id',
        'caja_id',
        'cli_id',
        'det_id',
        'med_id',
        'emp_id',
        'estado',
        'observacion',
        'referencia',
    ];

    public function detalle()
    {
        return $this->belongsTo(Detalle::class, 'det_id');
    }
    
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'med_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'emp_id');
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

}
