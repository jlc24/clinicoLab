<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodologia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre', 
        'descripcion',
    ];

    public function procedimientos()
    {
        return $this->hasMany(Procedimiento::class);
    }
}
