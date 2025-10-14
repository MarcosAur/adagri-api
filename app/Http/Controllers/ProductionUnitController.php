<?php

namespace App\Http\Controllers;

use App\Http\Requests\Producer\StoreProducerRequest;
use App\Http\Requests\ProductionUnit\StoreProductionUnitRequest;
use App\Http\Requests\ProductionUnit\UpdateProductionUnitRequest;
use App\Models\ProductionUnit;
use App\Services\Producer\IndexProducerService;
use App\Services\Producer\StoreProducerService;
use App\Services\ProductionUnit\DeleteProductionUnitService;
use App\Services\ProductionUnit\StoreProductionUnitService;
use App\Services\ProductionUnit\UpdateProductionUnitService;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class ProductionUnitController extends Controller
{
    public function index(IndexProducerService $indexProducerService){
        $productionUnits = $indexProducerService->run([]);
        return response()->json($productionUnits);
    }

    public function store(
        StoreProductionUnitRequest $storeProductionUnitRequest,
        StoreProductionUnitService $storeProductionUnitService,
    ){

        $data = $storeProductionUnitRequest->validated();
        $producer = $storeProductionUnitService->run($data);  
        return response()->json($producer, 201);
    }

    public function update(
        UpdateProductionUnitRequest $updateProductionUnitRequest,
        UpdateProductionUnitService $updateProductionUnitService,
        ProductionUnit $productionUnit
    ){
        $data = $updateProductionUnitRequest->validated();
        $productionUnit = $updateProductionUnitService->run($data, $productionUnit);
        return response()->json($productionUnit);
    }

    public function destroy(
        DeleteProductionUnitService $deleteProductionUnitService,
        ProductionUnit $productionUnit
    ){
        $deleted = $deleteProductionUnitService->run($productionUnit);
        return response()->json($deleted, 200);
    }
}
