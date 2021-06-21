<?php

namespace App\Http\Controllers;

use App\Contacto;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContacto;
use App\Http\Requests\UpdateContacto;

class ContactoController extends Controller
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
    public function store(StoreContacto $request)
    {
        $contacto = Contacto::create([
            'persona_dni'=> strtoupper($request->input('contacto')['persona_dni']),
            'contacto_nombre'=> strtoupper($request->input('contacto')['contacto_nombre']),
            'relacion'=> strtoupper($request->input('contacto')['relacion']),
            'celular'=> $request->input('contacto')['celular'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(StoreContacto $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContacto $request)
    {
        Contacto::where('id', $request->input('contacto')['id'])
            ->update([
                'contacto_nombre' => strtoupper($request->input('contacto')['contacto_nombre']),
                'relacion' => strtoupper($request->input('contacto')['relacion']),
                'celular' => strtoupper($request->input('contacto')['celular']),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        //
    }
}
