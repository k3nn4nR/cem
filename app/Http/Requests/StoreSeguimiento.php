<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeguimiento extends FormRequest
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
            'fecha'         => 'required|date',
            'detalles'      => 'required',
            'detalles.*'    => 'required|exists:detalle_casos,id',
            'personales'    => 'required',
            'personales.*'  => 'required|exists:personal,id',
        ];
    }

    public function messages()
    {
        return [
            'fecha.required'        => 'La fecha del seguimiento es requerido.',
            'fecha.date'            => 'Formato incorrecto de la fecha.',
            'detalles.required'     => 'Se requieren los detalles.',
            'detalles.*.required'   => 'El detalle es requerido.',
            'detalles.*.exists'     => 'El detalle no existe.',
            'personales.required'   => 'Se requiere quien hizo el seguimiento.',
            'personales.*.exists'   => 'El personal no esta registrado en la bd.',
        ];
    }
}
