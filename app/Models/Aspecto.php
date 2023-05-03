<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
    ];

    public function componenteaspectos()
    {
        return $this->hasMany(ComponenteAspecto::class);
    }
}
