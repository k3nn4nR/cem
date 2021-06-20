<?php

namespace App\Http\Controllers;

use App\Seguimiento;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSeguimiento;

class SeguimientoController extends Controller
{
    public function all()
    {
        return Seguimiento::with('detalles.agresor','personal')->get();
    }

    public function maestro()
    {
        return view('seguimiento.maestro');
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
    public function store(StoreSeguimiento $request)
    {
        foreach($request->input('detalles') as $detalle){
            $seguimiento = Seguimiento::create([
                'detalle_caso_id' => $detalle,
                'fecha' => $request->input('fecha'),
            ]);
            $seguimiento->personal()->attach($request->input('personales'),['comentario' => strtoupper($request->input('comentario'))]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seguimiento $seguimiento)
    {
        //
    }
}
