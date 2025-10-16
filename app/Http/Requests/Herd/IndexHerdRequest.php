<?php

namespace App\Http\Requests\Herd;

use Illuminate\Foundation\Http\FormRequest;

class IndexHerdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filters.species' => ['nullable'],
            'filters.rural_property_id' => ['nullable'],
            'filters.per_page' => ['nullable'],
        ];
    }
}
