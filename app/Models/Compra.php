<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'mat_id',
        'comp_elaboracion',
        'comp_vencimiento',
        'umed_id',
        'comp_cantidad',
        'comp_precio_compra',
        'comp_precio_unitario',
        'comp_tipo',
        'prov_id',
        'comp_observacion',
        'comp_estado',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'mat_id');
    }

    public function umedida()
    {
        return $this->belongsTo(UMedida::class, 'umed_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'prov_id');
    }
}
