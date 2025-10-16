<?php

namespace App\Services\Producer;

use App\Models\Producer;

class DeleteProducerService
{
    public function run(Producer $producer): bool
    {
        if ($producer->ruralProperty->count()) {
            throw new \Exception("Não é possivel deletar o produtor");
        }

        return $producer->delete();
    }
}