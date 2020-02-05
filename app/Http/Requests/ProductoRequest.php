<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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

            'codigo_interno' => 'required',
            'descripcion' => 'required',
            'id_dimensional' => 'required',
            'tipo_producto' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'codigo_barras.required' => 'El codigo de barras es requerido',
            'codigo_barras.max' => 'El codigo de barras debe tener 13 caracteres',
            'codigo_barras.min' => 'El codigo de barras debe tener 13 caracteres',
            'codigo_interno.required' => 'El codigo interno es requerido',
            'descripcion.required' => 'El campo descripcion es requerido',
            'id_dimensional.required' => ' Debe seleccionar una dimensional',
            'id_presentacion.required' => 'Debe seleccionar una presentacion',
            'tipo_producto.required' => 'Debe seleccionar un Tipo de Producto'
        ];
    }
}
