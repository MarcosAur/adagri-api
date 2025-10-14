<?php

namespace App\Http\Requests\RuralProperty;

use Illuminate\Foundation\Http\FormRequest;

class StoreRuralPropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rural_property.name' => ['required', 'string'],
            'rural_property.state_registration' => ['required', 'unique:rural_properties,state_registration'],
            'rural_property.total_area' => ['required', 'numeric'],
            'rural_property.producer_id' => ['required', 'exists:producers,id'],
            'address.address' => ['required', 'string'],
            'address.number' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
        ];
    }

}
