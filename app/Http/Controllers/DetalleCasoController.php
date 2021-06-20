<?php

namespace App\Http\Controllers;

use App\DetalleCaso;
use Illuminate\Http\Request;

class DetalleCasoController extends Controller
{
    public function all()
    {
        return DetalleCaso::with('caso')->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetalleCaso  $detalleCaso
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleCaso $detalleCaso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleCaso  $detalleCaso
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleCaso $detalleCaso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleCaso  $detalleCaso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleCaso $detalleCaso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleCaso  $detalleCaso
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleCaso $detalleCaso)
    {
        //
    }
}
