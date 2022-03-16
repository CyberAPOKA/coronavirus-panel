<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidacao extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo nome é necessário',
            'name.max' => 'O limite máximo de 255 caracteres está excedido',
            'email.required' => 'Campo e-mail é necessario',
            'email.email' => 'O e-mail precisa ser um e-mail válido',
            'password.required' => 'Campo senha é necessário',
            'password.min:8' => 'A senha precisa conter no mínimo 8 caracteres',
            'password.confirmed' => 'Os campos senha e confirmar senha não coincidem' 
        ];
    }
}
