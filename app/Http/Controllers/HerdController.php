<?php

namespace App\Http\Controllers;

use App\Http\Requests\Herd\StoreHerdRequest;
use App\Http\Requests\Herd\UpdateHerdRequest;
use App\Models\Herd;
use App\Services\Herd\DeleteHerdService;
use App\Services\Herd\IndexHerdService;
use App\Services\Herd\StoreHerdService;
use App\Services\Herd\UpdateHerdService;

class HerdController extends Controller
{
    public function index(
        IndexHerdService $indexHerdService
    ){
        $herds = $indexHerdService->run([]);
        return response()->json($herds, 200);
    }

    public function store(
        StoreHerdRequest $storeHerdRequest,
        StoreHerdService $storeHerdService
    ){
        $data = $storeHerdRequest->validated();
        $herd = $storeHerdService->run($data);
        return response()->json($herd, 201);
    }

    public function update(
        UpdateHerdRequest $updateHerdRequest,
        UpdateHerdService $updateHerdService,
        Herd $herd
    ){
        $data = $updateHerdRequest->validated();
        $herd = $updateHerdService->run($data, $herd);

        return response()->json($herd, 200);
    }

    public function destroy(
        DeleteHerdService $deleteHerdService,
        Herd $herd
    ){
        $deleted = $deleteHerdService->run($herd);

        return response()->json($deleted, 200);
    }
}
