<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cli_cod',
        'cli_nombre', 
        'cli_apellido_pat', 
        'cli_apellido_mat', 
        'cli_ci_nit', 
        'cli_exp_ci', 
        'cli_fec_nac',
        'cli_genero', 
        'cli_correo',
        'cli_direccion',
        'cli_celular',
        'user_id',
        'cli_usuario',
        'cli_password',
        'dep_id',
        'mun_id',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'dep_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'mun_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    // public function recepcions()
    // {
    //     return $this->hasMany(Recepcion::class);
    // }
}
