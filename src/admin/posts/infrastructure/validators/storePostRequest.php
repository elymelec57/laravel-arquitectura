<?php

namespace Src\admin\posts\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class storePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];
    }
}