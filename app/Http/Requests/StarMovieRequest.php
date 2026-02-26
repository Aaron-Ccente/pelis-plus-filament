<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class StarMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'movie_id' => 'required|exists:movies,id',
            'star_number' => 'required|integer|min:1|max:5',
            'user_id' => 'required|integer'
        ];
    }

    public function attributes(): array
    {
    return [
        'movie_id' => 'película',
        'star_number' => 'calificación',
        'user_id' => 'usuario'
    ];
    }

    public function messages(): array
    {
        return [
            'movie_id.required' => 'Debe seleccionar una película.',
            'movie_id.exists' => 'La película seleccionada no existe.',
            'star_number.required' => 'Debe ingresar una calificación.',
            'star_number.integer' => 'La calificación debe ser un número entero.',
            'star_number.min' => 'La calificación mínima es 1 estrella.',
            'star_number.max' => 'La calificación máxima es 5 estrellas.',
            'user.required' => 'El usuario es requerido',
            'user.exists' => 'El usuario no existe'
            ];
    }
}
