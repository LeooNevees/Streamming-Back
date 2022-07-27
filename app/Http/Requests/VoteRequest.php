<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
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
            'movie_id' => 'required|integer',
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:200',
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
            'movie_id.required' => 'Necessário fornecer o Id do Filme/Série',
            'movie_id.integer' => 'Necessário que ID Filme/Série seja seja número inteiro',
            'title.required' => 'Necessário fornecer o Título da avaliação',
            'title.max' => 'Necessário que o Título possua no máximo 50 caracteres',
            'description.required' => 'Necessário fornecer a Descrição da avaliação',
            'description.max' => 'Necessário que a Descrição possua no máximo 200 caracteres',
        ];
    }

}
