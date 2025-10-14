<?php

namespace App\Services\RuralProperty;

use App\Models\RuralProperty;
use Illuminate\Support\Collection;

class IndexRuralPropertyService
{
    public function run(array $data): Collection
    {
        return RuralProperty::all();
    }
}