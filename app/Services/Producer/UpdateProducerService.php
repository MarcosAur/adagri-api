<?php

namespace App\Services\Producer;

use App\Models\Producer;

class UpdateProducerService
{
    public function run(array $data, Producer $producer): Producer
    {
        $producer->update($data);
        return $producer;
    }
}