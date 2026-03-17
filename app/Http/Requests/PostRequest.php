<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ==========================================
 * S - Single Responsibility Principle (SRP)
 * ==========================================
 * La responsabilidad de esta clase es ÚNICAMENTE validar 
 * los datos de entrada para la creación o actualización de un Post.
 * El controlador ya no tiene que preocuparse por la validación.
 */
class PostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ];
    }
}
