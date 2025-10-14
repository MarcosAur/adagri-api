<?php

namespace App\Services\ProductionUnit;

use App\Models\ProductionUnit;
use Illuminate\Support\Collection;

class IndexProductionUnitService
{
    public function run(array $data): Collection
    {
        return ProductionUnit::all();
    }
}