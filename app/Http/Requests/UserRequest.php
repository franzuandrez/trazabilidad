<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'nombre' => 'required',
            'id_rol' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'El campo usuario es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'password.required' => 'El campo de contraseña es obligatorio',
            'id_rol.required' => 'Debe Seleccionar un rol',
            'nombre.required' => 'El campo nombre es obligatorio',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ];
    }
}
