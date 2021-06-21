<?php

namespace App\Http\Controllers;

use App\Personal;
use Illuminate\Http\Request;
use App\Http\Requests\StorePersonal;

class PersonalController extends Controller
{
    public function all()
    {
        return Personal::with('persona')->get();
    }

    public function maestro()
    {
        return view('personal.maestro');
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
    public function store(StorePersonal $request)
    {
        $personal = Personal::create([
            'id'=> strtoupper($request->input('personal')['id']),
            'persona_dni'=> strtoupper($request->input('personal')['persona_dni']),
            'cargo'=> strtoupper($request->input('personal')['cargo']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show(Personal $personal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit(Personal $personal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $personal = Personal::find($request->input('id_original'));
        if($request->input('id_original') !=  $request->input('personal')['id']){
            $personal->id = strtoupper($request->input('personal')['id']);
        }
        $personal->persona_dni = strtoupper($request->input('personal')['persona_dni']);
        $personal->cargo = strtoupper($request->input('personal')['cargo']);
        $personal->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        //
    }
}
