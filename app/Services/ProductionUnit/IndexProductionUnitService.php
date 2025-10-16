<?php

namespace App\Services\ProductionUnit;

use App\Models\ProductionUnit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IndexProductionUnitService
{
    public function run(array $data): LengthAwarePaginator
    {

        $nameFilter = $data['filters']['name'] ?? null;
        $ruralPropertyIdFilter = $data['filters']['rural_property_id'] ?? null;
        $perPageFilter = $data['filters']['per_page'] ?? 10;

        return ProductionUnit::when($nameFilter, function ($query) use ($nameFilter) {
                $query->where('name', 'like', '%' . $nameFilter . '%');
            })
            ->when($ruralPropertyIdFilter, function ($query) use ($ruralPropertyIdFilter) {
                $query->where('rural_property_id', $ruralPropertyIdFilter);
            })
            ->paginate($perPageFilter);
    }
}