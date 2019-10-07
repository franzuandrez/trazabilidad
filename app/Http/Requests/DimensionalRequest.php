<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DimensionalRequest extends FormRequest
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
            'descripcion' => 'required',
            'unidad_medida' => 'required|max:5',
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'El campo descripcion es requerido',
            'unidad_medida.required' => 'El campo unidad de medida es requerido',
            'unidad_medida.max' => 'La unidad de medida no puede exceder 5 caracteres'
        ];
    }
}
