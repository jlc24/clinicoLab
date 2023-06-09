<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_cod',
        'usuario_nombre', 
        'usuario_apellido_pat', 
        'usuario_apellido_mat', 
        'usuario_ci_nit', 
        'usuario_exp_ci', 
        'usuario_fec_na',
        'usuario_genero', 
        'usuario_correo',
        'usuario_direccion',
        'usuario_celular', 
        'user_id',
        'usuario_usuario', 
        'usuario_password',
        'usuario_departamento',
        'usuario_municipio',
        'usuario_foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function permiso_users()
    {
        return $this->hasMany(PermisoUser::class);
    }
}
