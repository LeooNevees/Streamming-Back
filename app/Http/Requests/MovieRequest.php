<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'duration' => 'required|integer',
            'age_classification' => 'required|integer|min:0|max:100',
            'year_entry' => 'required|date_format:Y|size:4',
            'genre' => 'required|integer',
            'type_entertainment' => 'required|integer',
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
            'title.required' => 'Necessário fornecer o Título',
            'title.max' => 'Necessário que o Título possua no máximo 50 caracteres',
            'description.required' => 'Necessário fornecer a Descrição',
            'description.max' => 'Necessário que a Descrição possua no máximo 200 caracteres',
            'duration.required' => 'Necessário fornecer o Tempo de Duração',
            'duration.integer' => 'Necessário que Tempo de Duração seja número inteiro',
            'age_classification.required' => 'Necessário fornecer a Classificação de Idade',
            'age_classification.integer' => 'Necessário que Classificação de Idade seja número inteiro',
            'age_classification.min' => 'Necessário que Classificação de Idade seja maior que 0',
            'age_classification.max' => 'Necessário que Classificação de Idade seja menor que 100',
            'year_entry.required' => 'Necessário que fornecer o Ano de Lançamento',
            'year_entry.date_format' => 'Necessário que o formato do Ano de Lançamento seja YYYY',
            'year_entry.size' => 'Formato do Ano de Lançamento inválido',
            'genre.required' => 'Necessário fornecer o Gênero',
            'genre.integer' => 'Necessário que o Gênero seja número inteiro',
            'type_entertainment.required' => 'Necessário fornecer o Tipo do Entretenimento',
            'type_entertainment.integer' => 'Necessário que Tipo do Entretenimento seja número inteiro',
            'user.required' => 'Necessário fornecer o Usuário',
            'user.integer' => 'Necessário que o Usuário seja número inteiro',
        ];
    }
}
