<?php

namespace App\Services\Address;

use App\Models\Address;

class StoreAddressService
{
    public function run(array $data, int $addressableId, string $addressableType): bool
    {
        $data['addressable_id'] = $addressableId;
        $data['addressable_type'] = $addressableType;
        $address = Address::create($data);

        return $address->delete();
    }
}