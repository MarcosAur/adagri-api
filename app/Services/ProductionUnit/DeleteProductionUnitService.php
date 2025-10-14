<?php

namespace App\Services\ProductionUnit;

use App\Models\ProductionUnit;

class DeleteProductionUnitService
{
    public function run(ProductionUnit $productionUnit): bool
    {
        return $productionUnit->delete();
    }
}