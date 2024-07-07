<?php

namespace App\Http\Requests\Container;

use App\Enum\InspectionStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListContainerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'origin' => 'array',
            'origin.*' => 'required|string|max:255',
            'destination' => 'array',
            'destination.*' => 'required|string|max:255',
            'inspection_status' => 'array',
            'inspection_status.*' => ['required', Rule::enum(InspectionStatus::class)],
            'packing_list' => 'string|max:255',
            'items_count' => 'integer|min:0|max:2147483647',
        ];
    }
}
