<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $fillable = [
    'codigo_ingreso',
    'habitacion',
    'fecha',
    'medico_id',
    'paciente_id'
    ];
    public function medico(){
        return $this->belongsTo('App\Models\Medico');
    }
    public function paciente(){
        return $this->belongsTo('App\Models\Paciente');
    }
}
