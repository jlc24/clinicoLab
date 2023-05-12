<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'det_id',
        'mat_id',
        'cantidad',
        'umed_id',
        'precio_total'
    ];

    public function detalle()
    {
        return $this->belongsTo(Detalle::class, 'det_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'mat_id');
    }

    public function umedida()
    {
        return $this->belongsTo(UMedida::class, 'umed_id');
    }
}
