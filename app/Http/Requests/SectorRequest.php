<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectorRequest extends FormRequest
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
            'id_bodega' => 'required',
            'id_localidad' => 'required',
            'codigo_barras' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_bodega.required' => 'Debe seleccionar una bodega',
            'id_localidad.required' => 'Debe seleccionar una localidad',
            'codigo_barras.required' => 'El codigo de barras es requerido'];
    }
}
