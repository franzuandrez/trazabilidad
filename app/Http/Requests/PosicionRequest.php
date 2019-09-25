<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosicionRequest extends FormRequest
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
            'id_nivel' => 'required',
            'codigo_barras' => 'required',
            'descripcion' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_nivel.required' => 'Debe seleccionar un nivel',
            'codigo_barras.required' => 'El codigo de barras es obligatorio',
            'descripcion.required' => 'El campo descripcion es obligatorio'
        ];
    }
}
