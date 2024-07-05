<?php

namespace App\Http\Requests\Container;

use Illuminate\Foundation\Http\FormRequest;

class ListContainerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100'
        ];
    }
}
