<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContacto extends FormRequest
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
            'contacto.persona_dni'       => 'required|exists:personas,dni',
            'contacto.contacto_nombre'   => 'required',
            'contacto.relacion'          => 'required',
            'contacto.celular'           => 'required|regex:/^([0-9]{9})$/',
        ];
    }

    public function messages()
    {
        return [
            'contacto.persona_dni.required'     => 'Se requiere el dni de la persona.',
            'contacto.persona_dni.exists'       => 'El dni no existe.',
            'contacto.contacto_nombre.required' => 'Se requiere el nombre comppleto del contacto.',
            'contacto.relacion.required'        => 'Se requiere la relacion con el contacto.',
            'contacto.celular.required'         => 'Se requiere el numero celular',            
            'contacto.celular.regex'            => 'El numero celular tiene que tener 9 digitos.',
        ];
    }
}
