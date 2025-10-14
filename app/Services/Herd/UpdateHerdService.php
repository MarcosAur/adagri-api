<?php

namespace App\Services\Herd;

use App\Models\Herd;

class UpdateHerdService
{
    public function run(array $data, Herd $herd): Herd
    {
        $herd->update($data);
        return $herd;
    }
}