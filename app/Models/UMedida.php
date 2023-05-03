<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMedida extends Model
{
    use HasFactory;

    protected $fillable = [
        'unidad', 
    ];

    public function componenteaspectos()
    {
        return $this->hasMany(ComponenteAspecto::class);
    }

    public function parametros()
    {
        return $this->hasMany(Parametro::class);
    }
}
