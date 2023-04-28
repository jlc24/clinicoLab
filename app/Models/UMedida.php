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

    public function detallecomponentes()
    {
        return $this->hasMany(DetalleComponente::class);
    }
}
