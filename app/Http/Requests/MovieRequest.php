<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MovieRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Approuver tous de request
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer|min:1888|max:' . (date('Y') + 1),
            'poster' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Un titre de film est requis',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères',
            'year.required' => 'L`année de sortie est requise',
            'year.integer' => 'L`année doit être un nombre valide',
            'year.min' => 'L`année ne peut pas être antérieure à 1888 (premier film connu)',
            'year.max' => 'L`année ne peut pas être dans un futur lointain',
            'poster.max' => 'L`URL de l`affiche ne peut pas dépasser 255 caractères'
        ];
    }
}
