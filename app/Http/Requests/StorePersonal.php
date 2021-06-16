<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonal extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'personal.id'           => 'required|unique:personal,id',
            'personal.persona_dni'  => 'required|exists:personas,dni|unique:personal,persona_dni',//evaluar si el dni que ingresa es el unico sin el soft delete
            'personal.cargo'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'personal.id.required'          => 'Se requiere el ID del nuevo personal.',
            'personal.id.unique'            => 'El ID ya esta ingresado en la BD.',
            'personal.persona_dni.required' => 'Se requiere el DNI del nuevo personal.',
            'personal.persona_dni.exists'   => 'El DNI no existe en la bd',
            'personal.persona_dni.unique'   => 'Esta persona ya esta registrada como personal.',
            'personal.cargo.required'       => 'Se requiere el cargo.',
        ];
    }
}
