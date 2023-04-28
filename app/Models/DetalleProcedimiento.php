<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProcedimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'det_id',
        'proc_id',
        'estado'
    ];

    public function detalle()
    {
        return $this->belongsTo(Detalle::class, 'det_id');
    }

    public function procedimiento()
    {
        return $this->belongsTo(Procedimiento::class, 'proc_id');
    }
}
