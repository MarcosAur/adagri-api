<?php

namespace App\Services\RuralProperty;

use App\Models\RuralProperty;

class StoreRuralPropertyService
{
    public function run(array $data): RuralProperty
    {
        $ruralProperty = RuralProperty::create($data);
        return $ruralProperty;
    }
}