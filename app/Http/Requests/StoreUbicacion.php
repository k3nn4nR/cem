<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUbicacion extends FormRequest
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
            'ubicacion.persona_dni'  => 'required|exists:personas,dni',
            'ubicacion.direccion'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            
            'ubicacion.persona_dni.required'    => 'Se requiere el Apellido Paterno.',
            'ubicacion.persona_dni.exists'      => 'Se requiere el Apellido Paterno.',
            'ubicacion.direccion.required'      => 'Se requiere el DNI.',
        ];
    }
}
