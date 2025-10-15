<?php

namespace App\Services\Herd;

use App\Models\Herd;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IndexHerdService
{
    public function run(array $data): LengthAwarePaginator
    {
        $specieFilter = $data['filters']['species'] ?? null;
        $ruralPropertyFilter = $data['filters']['rural_property_id'] ?? null;

        return Herd::when($specieFilter, function ($query) use ($specieFilter) {
                $query->where('species', 'like', '%' . $specieFilter . '%');
            })
            ->when($ruralPropertyFilter, function ($query) use ($ruralPropertyFilter) {
                $query->where('rural_property_id', $ruralPropertyFilter);
            })
            ->paginate(10);
    }
}