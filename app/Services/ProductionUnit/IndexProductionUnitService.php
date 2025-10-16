<?php

namespace App\Services\ProductionUnit;

use App\Models\ProductionUnit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class IndexProductionUnitService
{
    public function run(array $data): LengthAwarePaginator | Collection 
    {

        $nameFilter = $data['filters']['name'] ?? null;
        $ruralPropertyIdFilter = $data['filters']['rural_property_id'] ?? null;
        $perPageFilter = $data['filters']['per_page'] ?? 10;

        return ProductionUnit::with(['ruralProperty'])
            ->when($nameFilter, function ($query) use ($nameFilter) {
                $query->where('name', 'like', '%' . $nameFilter . '%');
            })
            ->when($ruralPropertyIdFilter, function ($query) use ($ruralPropertyIdFilter) {
                $query->where('rural_property_id', $ruralPropertyIdFilter);
            })
            ->orderBy('created_at','desc')
            ->when(isset($data['filters']['per_page']), function ($query) use ($perPageFilter){
                return $query->paginate($perPageFilter);
            }, function($query){
                return $query->get();
            });
    }
}