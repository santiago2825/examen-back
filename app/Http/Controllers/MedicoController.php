<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index(){
        $medicos = Medico::all();
        return response()->json($medicos);
    }
    public function store(Request $request){
        $request->validate([
            'codigo_medico' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255'
        ]);
        $medico = Medico::create($request->all());
        return response()->json($medico);
    }
    public function update(Request $request, $id){
        $request->validate([
            'codigo_medico' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255'
        ]);
        $medico = Medico::find($id);
        $medico->update($request->all());
        return response()->json($medico);
    }
    public function show($id){
        $medico=Medico::find($id);
        return response()->json($medico);
    }
    public function destroy(Medico $medico){
        $medico->delete();
        return response()->json($medico);
    }
}
