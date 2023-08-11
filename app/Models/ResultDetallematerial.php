<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultDetallematerial extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'result_id',
        'detmat_id',
        'ca_id',
        'mat_id',
        'cantidad',
        'umed_id',
        'precio_total'
    ];

}
