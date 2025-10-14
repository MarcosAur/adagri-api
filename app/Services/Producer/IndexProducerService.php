<?php

namespace App\Services\Producer;

use App\Models\Producer;
use Illuminate\Support\Collection;

class IndexProducerService
{
    public function run(array $data): Collection
    {
        return Producer::all();
    }
}