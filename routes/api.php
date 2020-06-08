<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Estudiante;
use App\Salone;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Listar todos los estudiantes
Route::get('estudiantes', function (){
    $estudiantes = Estudiante::get();
    return $estudiantes;
});

//Listar todos los salones
Route::get('salones', function (){
    $salones = Salone::get();
    return $salones;
});

//listar Salon
Route::get('salones/{id}', function(Request $request, $id){
    return $salon = Salone::findOrFail($id);
});

//listar Estudiante
Route::get('estudiantes/{id}', function(Request $request, $id){
    return $estudiante = Estudiante::findOrFail($id);
});


//Insertar Estudiantes
Route::post('estudiantes', function (Request $request) {
    $request->validate([
        'est_cod' => 'required|max:10000|numeric|unique:estudiantes',
        'est_nom' => 'required|max:35',
        'est_ap' => 'required|max:35',
        'est_cur' => 'required|max:10000|numeric',
        'sexo' => 'required|max:35',
    ]);
    $estudiante = new Estudiante;
    $estudiante->est_cod = $request->input('est_cod');
    $estudiante->est_nom = $request->input('est_nom');
    $estudiante->est_ap = $request->input('est_ap');
    $estudiante->est_cur = $request->input('est_cur');
    $estudiante->sexo = $request->input('sexo');
    $estudiante->save();
    return "Estudiante creado";
    
});

//Insertar Salones
Route::post('salones', function (Request $request) {
    $request->validate([
        'sal_cod' => 'required|max:10000|numeric|unique:salones',
        'sal_cur' => 'required|max:10000'
    ]);
    $salon = new Salone;
    $salon->sal_cod = $request->input('sal_cod');
    $salon->sal_cur = $request->input('sal_cur');
    $salon->save();
    return "Salón creado";
    
});

//Actualizar Salones
Route::put('salones/{id}', function(Request $request, $id){
    $request->validate([
        'sal_cod' => 'required|max:10000|numeric|unique:salones,sal_cod,'.$id,
        'sal_cur' => 'required|max:10000'
    ]);
    $salon = Salone::findOrFail($id);
    $salon->sal_cod = $request->input('sal_cod');
    $salon->sal_cur = $request->input('sal_cur');
    $salon->save();
    return "Salón actualizado";
});

//Actalizar Estudiantes
Route::put('estudiantes/{id}', function(Request $request, $id){
    $request->validate([
        'est_cod' => 'required|max:10000|numeric|unique:estudiantes,est_cod,'.$id,
        'est_nom' => 'required|max:35',
        'est_ap' => 'required|max:35',
        'est_cur' => 'required|max:10000|numeric',
        'sexo' => 'required|max:35',
    ]);
    $estudiante = Estudiante::findOrFail($id);
    $estudiante->est_cod = $request->input('est_cod');
    $estudiante->est_nom = $request->input('est_nom');
    $estudiante->est_ap = $request->input('est_ap');
    $estudiante->est_cur = $request->input('est_cur');
    $estudiante->sexo = $request->input('sexo');
    $estudiante->save();
    return "Estudiante actualizado";
});

//Eliminar Salón
Route::delete('salones/{id}', function ($id){
    $salon = Salone::findOrFail($id);
    $salon->delete();
    return 'Salon eliminado exitosamente';
});

//ELiminar estudiante
Route::delete('estudiantes/{id}', function ($id){
    $estudiante = Estudiante::findOrFail($id);
    $estudiante->delete();
    return 'Estudiante eliminado exitosamente';
});