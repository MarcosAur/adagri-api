<?php

namespace App\Services\Producer;

use App\Models\Producer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexProducerService
{
    public function run(array $data): LengthAwarePaginator
    {
        $nameFilter = $data['filters']['name'] ?? null;
        $documentFilter = $data['filters']['document'] ?? null;
        $phoneFilter = $data['filters']['phone'] ?? null;
        $emailFilter = $data['filters']['email'] ?? null;
        $perPageFilter = $data['filters']['per_page'] ?? 10;
    

        return Producer::when($nameFilter, function ($query, $nameFilter) {
                $query->where('name', 'like', '%' . $nameFilter . '%');
            })
            ->when($documentFilter, function ($query, $documentFilter) {
                $query->where('document', 'like', '%' . $documentFilter . '%');
            })
            ->when($phoneFilter, function ($query, $phoneFilter) {
                $query->where('phone', 'like', '%' . $phoneFilter . '%');
            })
            ->when($emailFilter, function ($query, $emailFilter) {
                $query->where('email', 'like', '%' . $emailFilter . '%');
            })
            ->paginate($perPageFilter);
    }
}