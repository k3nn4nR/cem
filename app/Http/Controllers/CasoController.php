<?php

namespace App\Http\Controllers;

use App\Caso;
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
        return Caso::all();
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
    public function store(Request $request)
    {
        d($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function show(Caso $caso)
    {
        //
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
