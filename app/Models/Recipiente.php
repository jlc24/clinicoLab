<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipiente extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
    ];

    public function detalles()
    {
        return $this->hasMany(Detalle::class);
    }
}
