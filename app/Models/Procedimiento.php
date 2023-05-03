<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'metodo_id',
    ];

    public function metodologia()
    {
        return $this->belongsTo(Metodologia::class, 'metodo_id');
    }

    public function detalleprocedimientos()
    {
        return $this->hasMany(DetalleProcedimiento::class);
    }
}
