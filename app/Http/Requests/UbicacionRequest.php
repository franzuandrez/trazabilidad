<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbicacionRequest extends FormRequest
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
            'id_localidad'=>'required',
            'id_bodega'=>'required',
            'id_sector'=>'required',
            'id_pasillo'=>'required',
            'id_rack'=>'required',
            'id_nivel'=>'required',
            'id_posicion'=>'required',
            'id_bin'=>'required',
        ];
    }

    function messages()
    {
       return [
           'id_localidad.required'=>'Debe seleccionar una localidad',
           'id_bodega.required'=>'Debe seleccionar una bodega',
           'id_sector.required'=>'Debe seleccionar un sector',
           'id_pasillo.required'=>'Debe seleccionar un pasillo',
           'id_rack.required'=>'Debe seleccionar un rack',
           'id_nivel.required'=>'Debe seleccionar un nivel',
           'id_posicion.required'=>'Debe seleccionar una posición',
           'id_bin.required'=>'Debe seleccionar un bin'
       ];
    }
}
