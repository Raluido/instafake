<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Log;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nick' => 'required|unique:users,nick',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'avatar' => 'required|mimes:jpg,png,jpeg',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'El email utilizado no tiene un formato adecuado',
            'email.unique' => 'El email ya está siendo usado por otro usuario',
            'avatar.mimes' => 'La extension seleccionada no esta permitida',
            'password.required' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un caracter espacial, un número y una longitud de al menos 10 dígitos',
            'password.confirmed' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un caracter espacial, un número y una longitud de al menos 10 dígitos',
            'password.min' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un caracter espacial, un número y una longitud de al menos 10 dígitos',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un caracter espacial, un número y una longitud de al menos 10 dígitos',
            'repeatPassword.required' => 'Tienes que repetir la contraseña del apartado superior aqui',
        ];
    }
}
