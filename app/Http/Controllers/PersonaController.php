<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Requests\StorePersona;
use App\Http\Requests\UpdatePersona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return Persona::all();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StorePersona $request)
    {
        $persona = Persona::create([
            'dni'=> $request->input('persona')['dni'],
            'ape_paterno'=> strtoupper($request->input('persona')['ape_paterno']),
            'ape_materno'=> strtoupper($request->input('persona')['ape_materno']),
            'nombres'=> strtoupper($request->input('persona')['nombres']),
            'celular'=> $request->input('persona')['celular'],
            'edad'=> $request->input('persona')['edad'],
            'nivel_riesgo'=> $request->input('persona')['nivel_riesgo'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersona $request)
    {
        $persona = Persona::find($request->input('dni_original'));
        if($request->input('dni_original') !=  $request->input('persona')['dni']){
            $persona->dni = $request->input('persona')['dni'];
        }
        $persona->ape_paterno = strtoupper($request->input('persona')['ape_paterno']);
        $persona->ape_materno = strtoupper($request->input('persona')['ape_materno']);
        $persona->nombres = strtoupper($request->input('persona')['nombres']);
        $persona->celular = $request->input('persona')['celular'];
        $persona->edad = $request->input('persona')['edad'];
        $persona->nivel_riesgo = $request->input('persona')['nivel_riesgo'];
        $persona->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }

    public function allContactos(Persona $persona)
    {
        return Persona::find($persona->dni)->contactos;
    }

    public function allUbicaciones(Persona $persona)
    {
        return Persona::find($persona->dni)->ubicaciones;
    }

    public function allCasos(Persona $persona)
    {
        return Persona::find($persona->dni)->casos;
    }
}
