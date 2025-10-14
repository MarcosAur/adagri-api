<?php

namespace App\Services\Address;

use App\Models\Address;

class DeleteAddressService
{
    public function run(Address $address): bool
    {
        return $address->delete();
    }
}