<?php

namespace App\Services\Herd;

use App\Models\Herd;

class DeleteHerdService
{
    public function run(Herd $herd): bool
    {
        return $herd->delete();
    }
}