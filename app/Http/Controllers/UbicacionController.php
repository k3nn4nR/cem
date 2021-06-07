<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUbicacion;

class UbicacionController extends Controller
{
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
    public function store(StoreUbicacion $request)
    {
        $ubicacion = Ubicacion::create([
            'persona_dni'=> strtoupper($request->input('ubicacion')['persona_dni']),
            'direccion'=> strtoupper($request->input('ubicacion')['direccion']),
            'referencia'=> strtoupper($request->input('ubicacion')['referencia']),
            'tipo'=> strtoupper($request->input('ubicacion')['tipo']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Ubicacion::where('id', $request->input('ubicacion')['id'])
            ->update([
                'direccion' =>  strtoupper($request->input('ubicacion')['direccion']),
                'referencia' =>  strtoupper($request->input('ubicacion')['referencia']),
                'tipo' =>  strtoupper($request->input('ubicacion')['tipo']),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        //
    }
}
