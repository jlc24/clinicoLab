<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'mat_cod',
        'mat_nombre',
        'mat_descripcion',
        'mat_imagen',
        'umed_id',
        'mat_cantidad',
        'mat_cantidad_minima',
        'mat_precio_compra',
        'mat_precio_venta',
        'mat_precio_unitario',
        'mat_ventas',
        'mat_estado',
        'cat_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_id');
    }

    public function umedida()
    {
        return $this->belongsTo(UMedida::class, 'umed_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function detallematerials()
    {
        return $this->hasMany(DetalleMaterial::class);
    }
}
