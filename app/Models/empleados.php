<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleados extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'email',
        'nombre',
        'apellido',
        'telefono',
        'foto_perfil',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'habilidades',
        'experiencia_laboral',
        'educacion',
        'resumen',
    ];
}
