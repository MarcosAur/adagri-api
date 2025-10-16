<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuralProperty\IndexRuralPropertyRequest;
use App\Http\Requests\RuralProperty\StoreRuralPropertyRequest;
use App\Http\Requests\RuralProperty\UpdateRuralPropertyRequest;
use App\Models\RuralProperty;
use App\Services\Address\DeleteAddressService;
use App\Services\Address\StoreAddressService;
use App\Services\Address\UpdateAddressService;
use App\Services\Producer\DeleteProducerService;
use App\Services\RuralProperty\DeleteRuralPropertyService;
use App\Services\RuralProperty\IndexRuralPropertyService;
use App\Services\RuralProperty\StoreRuralPropertyService;
use App\Services\RuralProperty\UpdateRuralPropertyService;
use Illuminate\Support\Facades\DB;

class RuralPropertyController extends Controller
{
    public function index(
        IndexRuralPropertyRequest $indexRuralPropertyRequest,
        IndexRuralPropertyService $indexRuralPropertyService
    ){
        $data = $indexRuralPropertyRequest->validated();
        $ruralProperties = $indexRuralPropertyService->run($data);
        return response()->json($ruralProperties);
    }

    public function store(
        StoreRuralPropertyRequest $storeRuralPropertyRequest, 
        StoreRuralPropertyService $storeRuralPropertyService, 
        StoreAddressService $storeAddressService
    ){
        $data = $storeRuralPropertyRequest->validated();

        $ruralProperty = DB::transaction(function () use ($data, $storeRuralPropertyService, $storeAddressService){
            $ruralProperty = $storeRuralPropertyService->run($data['rural_property']);
            return $storeAddressService->run($data['address'], $ruralProperty->id, 'rural_property');
        });

        return response()->json($ruralProperty, 201);
    }

    public function update(
        UpdateRuralPropertyRequest $updateRuralPropertyRequest, 
        UpdateRuralPropertyService $updateRuralPropertyService,
        UpdateAddressService $updateAddressService,
        RuralProperty $ruralProperty
    ){
        $data = $updateRuralPropertyRequest->validated();

        $ruralProperty = DB::transaction(function () use ($data, $ruralProperty, $updateRuralPropertyService, $updateAddressService){
            $ruralProperty = $updateRuralPropertyService->run($data['rural_property'], $ruralProperty);
            $updateAddressService->run($data['address'], $ruralProperty->address);
            return $ruralProperty;
        });

        return response()->json($ruralProperty);        
    }

    public function destroy(
        DeleteRuralPropertyService $deleteRuralPropertyService,
        DeleteAddressService $deleteAddressService,
        RuralProperty $ruralProperty
    ){
        $returnValue = DB::transaction(function () use ($deleteRuralPropertyService, $deleteAddressService, $ruralProperty){
            $deleteRuralPropertyService->run($ruralProperty);
            $deleteAddressService->run($ruralProperty->address);
            return true;
        });
        return $returnValue ? response()->json($returnValue, 200) : response()->json($returnValue, 500);
    }
}
