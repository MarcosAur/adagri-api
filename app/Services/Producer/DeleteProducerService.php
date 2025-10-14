<?php

namespace App\Services\Producer;

use App\Models\Producer;

class DeleteProducerService
{
    public function run(Producer $producer): bool
    {
        return $producer->delete();
    }
}