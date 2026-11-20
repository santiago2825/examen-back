<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = [
    'codigo_paciente',
    'nombre',
    'apellido',
    'imagen_url',
    'imagen_public_id',
    ];
    public function Ingresos(){
        return $this->hasMany('App\Models\Ingreso');
    }
}
