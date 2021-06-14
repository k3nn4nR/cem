<?php

namespace App\Http\Controllers;

use App\Caso;
use App\DetalleCaso;
use App\Http\Requests\StoreCaso;
use Illuminate\Http\Request;

class CasoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return Caso::with('denuncuante')->get();
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
    public function store(StoreCaso $request)
    {
        $caso = Caso::create([
            'denunciante_dni' => strtoupper($request->input('denunciante_dni')),
            'fecha_caso' => strtoupper($request->input('fecha_caso')),
            'ficha' => strtoupper($request->input('ficha')),
            'lugar' => strtoupper($request->input('lugar')),
            'medida' => strtoupper($request->input('medida')),
            'observacion_abogado' => strtoupper($request->input('observacion_abogado')),
            'tipo' => strtoupper($request->input('tipo')),
        ]);
        foreach($request->input('detalles') as $detalle)
        {
            $detalle = DetalleCaso::create([
                'caso_ficha' => strtoupper($request->input('ficha')),
                'agresor_dni' => strtoupper($detalle["agresor_dni"]),
                'vinculo' => strtoupper($detalle["vinculo"]),
                'comentario' => strtoupper($detalle["comentario"]),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function show($caso)
    {
        return DetalleCaso::where('caso_ficha',$caso)->with('agresor')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function edit(Caso $caso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        d($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caso $caso)
    {
        //
    }
}
