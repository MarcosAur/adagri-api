<?php

namespace App\Http\Requests\RuralProperty;

use Illuminate\Foundation\Http\FormRequest;

class IndexRuralPropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filters.name' => ['nullable'],
            'filters.state_registration' => ['nullable'],
            'filters.producer_id' => ['nullable'],
        ];
    }
}
