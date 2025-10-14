<?php

namespace App\Services\Address;

use App\Models\Address;

class UpdateAddressService
{
    public function run(array $data, Address $address): Address
    {
        $address->update($data);
        return $address;
    }
}