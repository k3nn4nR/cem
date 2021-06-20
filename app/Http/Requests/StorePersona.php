<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersona extends FormRequest
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
            'persona.ape_paterno'   => 'required',
            'persona.ape_materno'   => 'required',
            'persona.nombres'       => 'required',
            'persona.dni'           => 'required|string|unique:personas,dni|regex:/^([0-9]{8})$/',
            'persona.celular'       => 'nullable|string|unique:personas,celular|regex:/^([0-9]{9})$/',
            'persona.edad'          => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'persona.ape_paterno.required'  => 'Se requiere el Apellido Paterno.',
            'persona.ape_materno.required'  => 'Se requiere el Apellido Materno.',
            'persona.nombres.required'      => 'Se requiere el(los) Nombres.',
            'persona.dni.required'          => 'Se requiere el DNI.',
            'persona.dni.string'            => 'El DNI tiene que ser un string.',
            'persona.dni.unique'            => 'El dni ya esta ingresado en la BD.',
            'persona.dni.regex'             => 'EL DNI tiene que tener 8 numeros.',
            'persona.celular.required'      => 'Se requiere el celular.',
            'persona.celular.string'        => 'El celular tiene que ser un string.',
            'persona.celular.unique'        => 'El celular ya esta ingresado en la BD.',
            'persona.celular.regex'         => 'El celular tiene que tener 9 numeros.',
            'persona.edad.required'         => 'Se requiere la edad.',
            'persona.edad.numeric'          => 'La eda tiene que ser un numero.',
        ];
    }
}
