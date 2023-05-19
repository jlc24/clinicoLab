<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'rec_id',
        'det_id',
        'dp_id',
        'dpc_id',
        'ca_id',
        'resultado'
    ];
}
