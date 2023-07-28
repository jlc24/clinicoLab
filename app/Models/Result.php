<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'fac_id',
        'rec_id',
        'det_id',
        'dp_id',
        'dpc_id',
        'ca_id',
        'det_mat_id',
        'resultado',
        'umed_id'
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'fac_id');
    }
}
