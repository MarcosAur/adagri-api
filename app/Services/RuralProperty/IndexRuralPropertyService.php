<?php

namespace App\Services\RuralProperty;

use App\Models\RuralProperty;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class IndexRuralPropertyService
{
    public function run(array $data): LengthAwarePaginator | Collection
    {
        $nameFilter = $data['filters']['name'] ?? null;
        $stateRegistrationFilter = $data['filters']['state_registration'] ?? null;
        $producerIdFilter = $data['filters']['producer_id'] ?? null;
        $perPageFilter = $data['filters']['per_page'] ?? 10;

        return RuralProperty::with(['address', 'producer'])
            ->when($nameFilter, function ($query, $nameFilter) {
                $query->where('name', 'like', '%' . $nameFilter . '%');
            })
            ->when($stateRegistrationFilter, function ($query, $stateRegistrationFilter) {
                $query->where('state_registration', 'like', '%' . $stateRegistrationFilter . '%');
            })
            ->when($producerIdFilter, function ($query, $producerIdFilter) {
                $query->where('producer_id', $producerIdFilter);
            })
            ->orderBy('created_at','desc')
            ->when(isset($data['filters']['per_page']), function ($query) use ($perPageFilter){
                return $query->paginate($perPageFilter);
            }, function($query){
                return $query->get();
            });
    }
}