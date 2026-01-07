<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    $students =  Student::all();

    if ($students->isEmpty()) {
      $response = [
        "message" => "no hay datos disponibles",
        "status" => 200
      ];
      return response()->json($response);
    }
    return response()->json($students, 200);
  }



  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // primero validamos los datos
    $student = [];
    // el método validated devuelve una redireccion por defecto sea que haya un error en validacion o no, esto en una app monolitica esta bien
    // pero en una APP que sirve una API debemos decirle que queremos 
    // que nos devuelva JSON en caso de errores 
    $response =  $request->validate([
      "name" => 'required',
      "lastname" => 'required',
      "email" => 'required',
      "languages" => 'required',
    ]);

    $student = Student::create($response);

    return response()->json(['message' => 'Estudiante creado correctamente', 'data' => $student], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //buscamos el estudiante
    $student = Student::find($id);

    if (!$student) {
      return response()->json(["message" => "usuario no encontrado", "status" => 404]);
    }


    return $student;
  }



  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {

    // con esto tambien podemos hacer validaciones
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:students,email',
    ], [
      'name.required' => 'El nombre es obligatorio',
      'email.unique' => 'Este correo ya está registrado',
    ]);
    if ($validator->fails()) {
      return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
    }

    // validaciones con el propio request
    /*   $response =  $request->validate([
      "name" => 'required',
      "lastname" => 'required',
      "email" => 'required',
      "languages" => 'required',
    ]);
 */

    // la diferencia entre ambos es que la clase Validator es más flexible en cuanto personalizacion de errores
    // mientras que con el método validate es más simple y poco personalizable

    $student = Student::find($id);
    $state = $student->update($validator);

    return response()->json($state, 204);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    // buscamos el recurso
    $student = Student::find($id);
    if (!$student) {
      return response()->json(["message" => "usuario no existe", "status" => 200]);
    }
    $student->delete();

    return response()->json(["message" => "usuario eliminado", "status" => 200]);
  }
}
