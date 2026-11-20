<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(){
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }
    public function store(Request $request){
        $request->validate([
            'codigo_paciente' => 'required|string|max:255',
            'nombre'=>'required|string|max:255',
            'apellido'=>'required|string|max:255',
            'imagen'=>'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);
        $file = $request->file('imagen');
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret')
            ],
            'url' => ['secure' => true],
        ]);
        $resultado = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder'=>'paciente',
                'resource_type' => 'image',
            ]
        );
        $pacientes = Paciente::create([
            'codigo_paciente' => $request->codigo_paciente,
            'nombre' => $request->nombre,
            'apellido' =>$request->apellido,
            'imagen_url' =>$resultado['secure_url'],
            'imagen_public_id' =>$resultado['public_id'],
        ]);
        return response()->json($pacientes);
    }
    public function update(Request $request, Paciente $paciente){
        $request->validate([
            'codigo_paciente' => 'required|string|max:255',
            'nombre'=>'required|string|max:255',
            'apellido'=>'required|string|max:255',
            'imagen'=>'sometimes|required|image|mimes:jpg,jpeg,png,webp|max:5120',

        ]);
    $paciente->fill($request->only([
            'codigo_paciente',
            'nombre',
            'apellido',
        ]));

    $oldImagePublicId = null;

    if ($request->hasFile('imagen')) {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        $uploaded = $cloudinary->uploadApi()->upload(
            $request->file('imagen')->getRealPath(),
            [
                'folder' => 'paciente',
                'resource_type' => 'image',
            ]
        );

        $oldImagePublicId = $paciente->imagen_public_id;
        $paciente->fill([
            'imagen_url' => $uploaded['secure_url'],
            'imagen_public_id' => $uploaded['public_id'],
        ]);
    }

    $paciente->save();

    if ($oldImagePublicId) {
        $cloudinary->uploadApi()->destroy($oldImagePublicId);
    }

    return response()->json([
        'message' => 'Elemento actualizado correctamente',
        'data' => $paciente
    ]);
    }
    public function show($id){
        $paciente=Paciente::find($id);
        return response()->json($paciente);
    }
    public function destroy(Paciente $medico){
        $medico->delete();
        return response()->json($medico);
    }
}
