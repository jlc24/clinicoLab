<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'cli_id',
        'user_id',
        'config_id',
        'fac_total',
        'fac_estado',
        'fac_pago',
        'fac_descuento',
        'fac_iva',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function configuration()
    {
        return $this->belongsTo(Configuration::class);
    }

    public function recepcions()
    {
        return $this->hasMany(Recepcion::class);
    }
}
