<?php

namespace App\Services\RuralProperty;

use App\Models\RuralProperty;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexRuralPropertyService
{
    public function run(array $data): LengthAwarePaginator
    {
        $nameFilter = $data['filters']['name'] ?? null;
        $stateRegistrationFilter = $data['filters']['state_registration'] ?? null;
        $producerIdFilter = $data['filters']['producer_id'] ?? null;

        return RuralProperty::when($nameFilter, function ($query, $nameFilter) {
                $query->where('name', 'like', '%' . $nameFilter . '%');
            })
            ->when($stateRegistrationFilter, function ($query, $stateRegistrationFilter) {
                $query->where('state_registration', 'like', '%' . $stateRegistrationFilter . '%');
            })
            ->when($producerIdFilter, function ($query, $producerIdFilter) {
                $query->where('producer_id', $producerIdFilter);
            })
            ->paginate(10);
    }
}