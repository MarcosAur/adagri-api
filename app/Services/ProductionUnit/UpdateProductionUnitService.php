<?php

namespace App\Services\ProductionUnit;

use App\Models\ProductionUnit;

class UpdateProductionUnitService
{
    public function run(array $data, ProductionUnit $productionUnit): ProductionUnit
    {
        $productionUnit->update($data);
        return $productionUnit;
    }
}