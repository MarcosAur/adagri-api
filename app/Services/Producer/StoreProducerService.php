<?php

namespace App\Services\Producer;

use App\Models\Producer;

class StoreProducerService
{
    public function run(array $data): Producer
    {
        $producer = Producer::create($data);
        return $producer;
    }
}