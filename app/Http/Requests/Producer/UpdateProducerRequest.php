<?php

namespace App\Http\Requests\Producer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProducerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'producer.name' => ['required', 'string'],
            'producer.document' => [
                'required',
                'string',
                Rule::unique('producers', 'document')->ignore($this->route('producer')),
            ],            'producer.phone' => ['required', 'string'],
            'producer.email' => ['required', 'string'],
            'producer.register_date' => ['required', 'date'],
            'address.address' => ['required', 'string'],
            'address.number' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
        ];
    }
}
