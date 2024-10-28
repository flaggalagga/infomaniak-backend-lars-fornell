<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Approuver tous de request
    }

    public function rules()
    {
        return [
            'author' => 'required|string|max:255',
            'body' => 'sometimes|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'author.required' => 'Le nom de l`auteur est requis',
            'author.max' => 'Le nom de l`auteur ne peut pas dépasser 255 caractères',
            'body.required' => 'Le contenu de la critique est requis',
            'body.max' => 'La critique ne peut pas dépasser 1000 caractères'
        ];
    }
}