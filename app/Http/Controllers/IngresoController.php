<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index(){
        $ingresos = Ingreso::with('medico','paciente')->get();
        return response()->json($ingresos);
    }
    public function store(Request $request){
        $request->validate([
            'codigo_ingreso' => 'required|string|max:255',
            'habitacion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'paciente_id' => 'required|integer|exists:pacientes,id',
            'medico_id' => 'required|integer|exists:medicos,id'
        ]);
        $ingreso = Ingreso::create($request->only([
            'codigo_ingreso',
            'habitacion',
            'fecha',
            'paciente_id',
            'medico_id',
        ]));
        return response()->json($ingreso);
    }
    public function update(Request $request, Ingreso $ingreso){
        $request->validate([
            'codigo_ingreso' => 'required|string|max:255',
            'habitacion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'paciente_id' => 'required|integer|exists:pacientes,id',
            'medico_id' => 'required|integer|exists:medicos,id'
        ]);
        $ingreso->update($request->only([
            'codigo_ingreso',
            'habitacion',
            'fecha',
            'paciente_id',
            'medico_id',
        ]));
        return response()->json($ingreso);
    }
    public function show($id){
        $Ingreso = Ingreso::with(['medico','paciente'])->find($id);
        return  response()->json($Ingreso);
    }
    public function destroy(Ingreso $ingreso){
        $ingreso->delete();
        return response()->json($ingreso);
    }
}
