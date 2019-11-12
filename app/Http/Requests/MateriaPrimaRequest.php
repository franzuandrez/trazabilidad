<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriaPrimaRequest extends FormRequest
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
            'orden_compra'=>'unique:recepcion_encabezado,orden_compra|required',
            'id_proveedor'=>'required',
            'documento_proveedor'=>'required'


        ];
    }

    public function messages()
    {
       return [
           'orden_compra.unique'=>'Orden ya existente',
           'orden_compra.required'=>'El campo No. Documento es obligatorio',
           'id_proveedor.required'=>'Debe seleccionar proveedor',
           'documento_proveedor.required'=>'El campo Documento Proveedor es obligatorio'
       ];
    }
}
