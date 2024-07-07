<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\InspectionStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DashboardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
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
