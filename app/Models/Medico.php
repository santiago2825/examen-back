<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $fillable = [
    'codigo_medico',
    'nombre',
    'apellido'
    ];
    public function ingresos(){
        return $this->hasMany('App\Models\Ingreso');
    }
}
