<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BodegaRequest extends FormRequest
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
            'id_localidad' => 'required',
            'id_encargado' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'codigo_barras.required' => 'El codigo de barras es obligatorio',
            'descripcion.required' => 'El campo descripcion es obligatorio',
            'id_localidad.required' => 'Debe seleccionar una localidad',
            'id_encargado.required' => 'Debe seleccionar un encargado',
        ];
    }
}
