<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresentacionRequest extends FormRequest
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
            'descripcion' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'codigo_barras.required' => 'El codigo de barras es requerido',
            'descripcion.required' => 'El campo descripcion es requerido'
        ];
    }
}
