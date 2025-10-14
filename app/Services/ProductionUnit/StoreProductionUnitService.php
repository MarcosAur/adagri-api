<?php

namespace App\Services\ProductionUnit;

use App\Models\ProductionUnit;

class StoreProductionUnitService
{
    public function run(array $data): ProductionUnit
    {
        $productionUnit = ProductionUnit::create($data);
        return $productionUnit;
    }
}