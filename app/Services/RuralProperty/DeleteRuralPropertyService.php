<?php

namespace App\Services\RuralProperty;

use App\Models\RuralProperty;

class DeleteRuralPropertyService
{
    public function run(RuralProperty $ruralProperty): bool
    {

        if( $ruralProperty->herds()->count() || $ruralProperty->productionUnits()->count()) {
            throw new \Exception("Não foi possivel deletar a propriedade");
        }

        return $ruralProperty->delete();
    }
}