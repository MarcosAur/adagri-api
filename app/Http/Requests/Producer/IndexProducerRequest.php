<?php

namespace App\Http\Requests\Producer;

use Illuminate\Foundation\Http\FormRequest;

class IndexProducerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filters.name' => ['nullable'],
            'filters.document' => ['nullable'],
            'filters.phone' => ['nullable'],
            'filters.email' => ['nullable'],
        ];
    }
}
