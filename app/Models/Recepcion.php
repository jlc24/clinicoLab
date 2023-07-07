<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'rec_codigo',
        'fac_id',
        'caja_id',
        'det_id',
        'med_id',
        'estado',
        'rec_ruta_file'
    ];

    public function detalle()
    {
        return $this->belongsTo(Detalle::class, 'det_id');
    }
    
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'fac_id');
    }

}
