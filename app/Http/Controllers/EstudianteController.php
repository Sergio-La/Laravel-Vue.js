<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Estudiante::where('id', auth()->id())->get();
        $estudiantes = Estudiante::get();
    return $estudiantes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'est_cod' => 'required|max:10000|numeric|unique:estudiantes',
            'est_nom' => 'required|max:35',
            'est_ap' => 'required|max:35',
            'est_cur' => 'required|max:10000|numeric',
            'sexo' => 'required|max:35',
        ]);
        $estudiante = new Estudiante();
        $estudiante->est_cod = $request->est_cod;
        $estudiante->est_nom = $request->est_nom;
        $estudiante->est_ap = $request->est_ap;
        $estudiante->est_cur = $request->est_cur;
        $estudiante->sexo = $request->sexo;
        $estudiante->user_id = auth()->id();
        $estudiante->save();
        return $estudiante;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'est_cod' => 'required|max:10000|numeric|unique:estudiantes,est_cod,'.$id,
            'est_nom' => 'required|max:35',
            'est_ap' => 'required|max:35',
            'est_cur' => 'required|max:10000|numeric',
            'sexo' => 'required|max:35',
        ]);
        $estudiante = Estudiante::find($id);
        $estudiante->est_cod = $request->est_cod;
        $estudiante->est_nom = $request->est_nom;
        $estudiante->est_ap = $request->est_ap;
        $estudiante->est_cur = $request->est_cur;
        $estudiante->sexo = $request->sexo;
        $estudiante->save();
        return $estudiante;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);
        $estudiante->delete();
    }
}
