<?php

namespace App\Http\Controllers;

use App\Http\Requests\Producer\IndexProducerRequest;
use App\Http\Requests\Producer\StoreProducerRequest;
use App\Http\Requests\Producer\UpdateProducerRequest;
use App\Models\Producer;
use App\Services\Address\DeleteAddressService;
use App\Services\Address\StoreAddressService;
use App\Services\Address\UpdateAddressService;
use App\Services\Producer\DeleteProducerService;
use App\Services\Producer\IndexProducerService;
use App\Services\Producer\StoreProducerService;
use App\Services\Producer\UpdateProducerService;
use Illuminate\Support\Facades\DB;

class ProducerController extends Controller
{
    public function index(
        IndexProducerRequest $indexProducerRequest,
        IndexProducerService $indexProducerService
    ){
        $data = $indexProducerRequest->validated();
        $producers = $indexProducerService->run($data);
        return response()->json($producers);
    }

    public function store(
        StoreProducerRequest $storeProducerRequest,
        StoreProducerService $storeProducerService,
        StoreAddressService $storeAddressService
    ){
        $data = $storeProducerRequest->validated();
        $producer = DB::transaction(function () use ($storeAddressService, $storeProducerService, $data){
            $producer = $storeProducerService->run($data['producer']);
            $storeAddressService->run($data['address'], $producer->id, 'producer');
            return $producer;
        });

        return response()->json($producer, 201);
    }

    public function update(
        Producer $producer, 
        UpdateProducerRequest $updateProducerRequest,
        UpdateProducerService $updateProducerService,
        UpdateAddressService $updateAddressService
    ){   
        $data = $updateProducerRequest->validated();
        $producer = DB::transaction(function () use ($producer, $data, $updateProducerService, $updateAddressService){
            $producer = $updateProducerService->run($data['producer'], $producer);
            $updateAddressService->run($data['address'], $producer->address);
            return $producer;
        });
        return response()->json($producer, 200);
    }

    public function destroy(Producer $producer, DeleteAddressService $deleteAddressService, DeleteProducerService $deleteProducerService){
        
        $deleted = DB::transaction(function () use ($producer, $deleteAddressService, $deleteProducerService){
            $deleteAddressService->run($producer->address);
            $deleteProducerService->run($producer);
        });

        return response()->json($deleted, 200);
    }
}
