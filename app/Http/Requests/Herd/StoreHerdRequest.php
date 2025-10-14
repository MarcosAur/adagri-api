<?php

namespace App\Http\Requests\Herd;

use Illuminate\Foundation\Http\FormRequest;

class StoreHerdRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'species' => ['required','string'],
            'quantity' => ['required','numeric'],
            'purpose' => ['required','string'],
            'last_update_date' => ['required','date'],
            'rural_property_id' => ['required','exists:rural_properties,id'],
        ];
    }
}
