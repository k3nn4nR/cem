<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUbicacion extends FormRequest
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
            'ubicacion.id'          => 'required|exists:ubicaciones,id',
            'ubicacion.direccion'   => 'required',
            'ubicacion.tipo'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ubicacion.id.required'         => 'Se requiere la ubicacion.',
            'ubicacion.id.exists'           => 'El registro de la ubicacion no existe.',
            'ubicacion.direccion.required'  => 'Se requiere la direccion',
            'ubicacion.tipo.required'       => 'Se requiere el descripcion del tipo de ubicacion.',
        ];
    }
}
