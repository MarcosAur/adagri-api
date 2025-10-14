<?php

namespace App\Services\RuralProperty;

use App\Models\RuralProperty;

class UpdateRuralPropertyService
{
    public function run(array $data, RuralProperty $ruralProperty): RuralProperty
    {
        $ruralProperty->update($data);
        return $ruralProperty;
    }
}