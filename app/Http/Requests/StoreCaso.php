<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCaso extends FormRequest
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
            'denunciante_dni'       => 'required|exists:personas,dni',
            'fecha_caso'            => 'required|date',
            'ficha'                 => 'required|unique:casos,ficha',
            'lugar'                 => 'required',
            'tipo'                  => 'required',
            'turno'                 => 'required',
            'detalles'              => 'required',
            'detalles.*.agresor_dni'=> 'required|exists:personas,dni|distinct',
            'detalles.*.comentario' => 'required|string',
            'detalles.*.vinculo'    => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'denunciante_dni.required'          => 'Se requiere Denunciante.',
            'denunciante_dni.exists'            => 'El denunciante no esta registrado en la BD.',
            'fecha_caso.required'               => 'Se requiere la fecha del caso.',
            'fecha_caso.date'                   => 'La fecha no es valido.',
            'ficha.required'                    => 'El numero de la ficha es requerida.',
            'ficha.unique'                      => 'El numero de la ficha ya existe.',
            'lugar.equired'                     => 'Se requiere el lugar de los hechos.',
            'tipo.required'                     => 'El tipo de caso es requerido',
            'turno.required'                    => 'El turno de caso es requerido',
            'detalles.required'                 => 'Se requieren los detalles (agresores).',
            'detalles.*.agresor_dni.required'   => 'Se requiere el Agresor.',
            'detalles.*.agresor_dni.exists'     => 'El agresor no esta registrado en la BD.',
            'detalles.*.agresor_dni.distinct'   => 'Ya se ingreso al agresor, escoja otro.',
            'detalles.*.comentario.required'    => 'Se requiere el comentario.',
            'detalles.*.comentario.string'      => 'El comentario tiene que ser string.',
            'detalles.*.vinculo.required'       => 'Se requiere el vinculo con el agresor.',
            'detalles.*.vinculo.string'         => 'El vinculo tiene que ser string.',
        ];
    }
}
