<?php

namespace App\Services\RuralProperty;

use App\Models\RuralProperty;

class DeleteRuralPropertyService
{
    public function run(RuralProperty $ruralProperty): bool
    {
        return $ruralProperty->delete();
    }
}