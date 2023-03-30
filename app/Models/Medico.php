<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'med_cod', 
        'med_nombre',
        'med_apellido_pat',
        'med_apellido_mat',
        'med_ci_nit',
        'med_exp_ci',
        'med_genero', 
        'med_correo',
        'med_direccion',
        'med_celular',
        'med_especialidad',
        'user_id',
        'med_usuario',
        'med_password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
