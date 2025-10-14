<?php

namespace App\Services\Herd;

use App\Models\Herd;
use Illuminate\Support\Collection;

class IndexHerdService
{
    public function run(array $data): Collection
    {
        return Herd::all();
    }
}