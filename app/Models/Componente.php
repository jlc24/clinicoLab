<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
    ];

    public function detalleprocedimientos()
    {
        return $this->hasMany(DetalleProcedimiento::class);
    }
}
