<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponenteAspecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'dpcomp_id',
        'asp_id',
        'umed_id'
    ];

    public function dpcomponente()
    {
        return $this->belongsTo(DpComponente::class, 'dp_id');
    }

    public function aspecto()
    {
        return $this->belongsTo(Aspecto::class, 'asp_id');
    }

    public function umedida()
    {
        return $this->belongsTo(UMedida::class, 'umed_id');
    }

    public function parametros()
    {
        return $this->hasMany(Parametro::class);
    }

    public function detallematerials()
    {
        return $this->hasMany(DetalleMaterial::class);
    }
}
