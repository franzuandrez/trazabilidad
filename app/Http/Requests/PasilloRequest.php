<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasilloRequest extends FormRequest
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
            'id_encargado' => 'required',
            'codigo_barras' => 'required',
            'id_sector' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'id_encargado.required' => 'Debe seleccionar un encargado',
            'codigo_barras.required' => 'El codigo de barras es obligatorio',
            'id_sector.required' => 'Debe seleccionar uns sector',
        ];
    }
}
