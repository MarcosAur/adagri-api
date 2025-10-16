<?php

namespace App\Http\Requests\ProductionUnit;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductionUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filters.name' => ['nullable'],
            'filters.rural_property_id' => ['nullable'],
            'filters.per_page' => ['nullable'],
        ];
    }
}
