<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Caja extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caja_monto_inicial',
        'caja_monto_final',
        'caja_cambio',
        'caja_estado',
    ];

    public static function obtenerEstadoCaja()
    {
        try {
            $user = Auth::user();
            $caja = Caja::where('user_id', $user->id)->latest()->first();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'no';
        }
        
        $hoy = now()->format('Y-m-d');
        if ($caja->caja_estado == 0) {
            $disponible = 'no';
        } elseif ($caja->created_at->format('Y-m-d') != $hoy) {
            $disponible = 'nofecha';
        }else {
            $disponible = 'si';
        }
        
        return $disponible;
    }

    public function recepcions()
    {
        return $this->hasMany(Recepcion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
