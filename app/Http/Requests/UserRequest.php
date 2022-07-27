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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:250',
            'email' => 'required|string|max:250|email:rfc,dns',
            'password' => 'required|string|min:5|max:15',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Necessário fornecer o Nome',
            'name.max' => 'Necessário que o Nome possua no máximo 200 caracteres',
            'email.required' => 'Necessário fornecer o E-mail',
            'email.max' => 'Necessário que o E-mail possua no máximo 200 caracteres',
            'email.email' => 'E-mail inválido',
            'password.required' => 'Necessário fornecer a Senha',
            'password.min' => 'Necessário que a Senha possua no mínimo 5 caracteres',
            'password.max' => 'Necessário que a Senha possua no máximo 15 caracteres',
        ];
    }
}
