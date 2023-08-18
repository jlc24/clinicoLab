<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UMedida extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria',
        'nombre',
        'unidad'
    ];

    public function detalles()
    {
        return $this->hasMany(Detalle::class);
    }

    public function componenteaspectos()
    {
        return $this->hasMany(ComponenteAspecto::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function detallematerials()
    {
        return $this->hasMany(DetalleMaterial::class);
    }
}
