<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColaboradorRequest extends FormRequest
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
            //
            'codigo_barras' => 'required',
            'nombre' => 'required',
            'apellido' => 'required'
        ];
    }

    public function messages()
    {

        return [
            'codigo_barras.required' => 'El codigo de barras es obligatorio',
            'nombre.required' => 'El campo nombre es obligatorio',
            'apellido.required' => ' El campo apellido es obligatorio'
        ];
    }
}
