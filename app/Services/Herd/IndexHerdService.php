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
        $perPageFilter = $data['filters']['per_page'] ?? 10;

        return Herd::with(['ruralProperty'])
            ->when($specieFilter, function ($query) use ($specieFilter) {
                $query->where('species', 'like', '%' . $specieFilter . '%');
            })
            ->when($ruralPropertyFilter, function ($query) use ($ruralPropertyFilter) {
                $query->where('rural_property_id', $ruralPropertyFilter);
            })
            ->orderBy('created_at','desc')
            ->when(isset($data['filters']['per_page']), function ($query) use ($perPageFilter){
                return $query->paginate($perPageFilter);
            }, function($query){
                return $query->get();
            });
    }
}