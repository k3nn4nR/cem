<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContacto extends FormRequest
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
            'contacto.id'               => 'required|exists:ubicaciones,id',
            'contacto.contacto_nombre'  => 'required',
            'contacto.relacion'         => 'required',
            'contacto.celular'          => 'required|regex:/^([0-9]{9})$/',
        ];
    }

    public function messages()
    {
        return [
            'contacto.id.required'              => 'Se requiere el contacto.',
            'contacto.id.exists'                => 'El registro del contacto no existe.',
            'contacto.contacto_nombre.required' => 'Se requiere el nombre del contacto',
            'contacto.relacion.required'        => 'Se requiere la relacion con el contacto.',
            'contacto.celular.required'         => 'Se requiere el celular.',
            'contacto.celular.regex'            => 'El numero celular tiene que tener 9 digitos.',
        ];
    }
}
