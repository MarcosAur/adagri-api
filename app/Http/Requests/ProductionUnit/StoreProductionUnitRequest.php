<?php

namespace App\Http\Requests\ProductionUnit;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductionUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'total_area_ha' => ['required', 'numeric'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
            'rural_property_id' => ['required', 'exists:rural_properties,id'],
        ];  
    }
}
