<?php

namespace App\Services\Herd;

use App\Models\Herd;

class StoreHerdService
{
    public function run(array $data): Herd
    {
        $herd = Herd::create($data);
        return $herd;
    }
}