<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpComponente extends Model
{
    use HasFactory;

    protected $fillable = [
        'dp_id',
        'comp_id'
    ];

    public function detaleprocedimiento()
    {
        return $this->belongsTo(DetalleProcedimiento::class, 'dp_id');
    }

    public function componente()
    {
        return $this->belongsTo(Componente::class, 'comp_id');
    }

    public function componenteaspectos()
    {
        return $this->hasMany(ComponenteAspecto::class, 'dpc_id');
    }
}
