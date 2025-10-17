<?php

use App\Exports\RuralPropertiesExport;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HerdController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductionUnitController;
use App\Http\Controllers\RuralPropertyController;
use App\Models\Address;
use App\Models\Herd;
use App\Models\ProductionUnit;
use App\Models\RuralProperty;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class,'user']);


    Route::prefix('report')->group(function () {
       Route::get('pdf-report', function(){
            $herdsPerProducer = [];
            $herds = Herd::join('rural_properties', 'rural_properties.id', '=', 'herds.rural_property_id')
                ->join('producers', 'producers.id', '=', 'rural_properties.producer_id')
                ->select('producers.name', 'herds.species', 'herds.quantity')
                ->get();

            foreach ($herds as $herd) {
                $herdsPerProducer[$herd->name][] = [
                    'name' => $herd->species,
                    'quantity' => $herd->quantity
                ];
            }

            $pdf = Pdf::loadView('herdsPerProducer', compact('herdsPerProducer'));        
            $now = Carbon::now()->format('d_m_Y_h_i_s');
            $pdf->save($now.'.pdf', 'public');
            return Storage::disk('public')->url($now.'.pdf');
        });
        
        Route::get('rural-properties-xlsx', function(){
            $now = Carbon::now()->format('d_m_Y_h_i_s');
            Excel::store(new RuralPropertiesExport, $now.'.xlsx', 'public');

            return Storage::disk('public')->url($now.'.xlsx');
        });

        Route::get('overview-graphics', function(){
            $valueToReturn = [];

            $hectarePerCuture = ProductionUnit::selectRaw('sum(total_area_ha) as total_area_ha, name as culture')
                ->groupBy('name')
                ->get()
                ->toArray();


            foreach ($hectarePerCuture as $value) {
                $culture = $value['culture'];
                $totalArea = $value['total_area_ha'];
                $valueToReturn['totalAreaPerCulture']['labels'][] = $culture;
                $valueToReturn['totalAreaPerCulture']['data'][] = $totalArea;
            }

            $quantityPerSpecie = Herd::selectRaw('sum(quantity) as quantity, species as specie')
            ->groupBy('specie')
            ->get()
            ->toArray();

            foreach ($quantityPerSpecie as $value) {
                $species = $value['specie'];
                $quantity = $value['quantity'];
                $valueToReturn['quantityPerSpecies']['labels'][] = $species;
                $valueToReturn['quantityPerSpecies']['data'][] = $quantity;
            }

            $ruralProperties = RuralProperty::with(['address'])
                ->get()
                ->toArray();

            $propertiesCountPerCity = [];

            foreach ($ruralProperties as $value) {
                $city = $value['address']['city'];
                
                if(array_key_exists($city, $propertiesCountPerCity)){
                    $propertiesCountPerCity[$city] += 1;
                } else {
                    $propertiesCountPerCity[$city] = 1;
                }
            }

            $valueToReturn['propertiesPerCity'] = [
                'labels' => array_keys($propertiesCountPerCity),
                'data' => array_values($propertiesCountPerCity),
            ];

            return $valueToReturn;
        });
    });

    Route::prefix('producer')->group(function(){
        Route::get('/', [ProducerController::class, 'index']);
        Route::post('/', [ProducerController::class, 'store']);
        Route::put('/{producer}', [ProducerController::class, 'update']);
        Route::delete('/{producer}', [ProducerController::class, 'destroy']);
    });

    Route::prefix('rural-property')->group(function(){
        Route::get('/', [RuralPropertyController::class, 'index']);
        Route::post('/', [RuralPropertyController::class, 'store']);
        Route::put('/{ruralProperty}', [RuralPropertyController::class, 'update']);
        Route::delete('/{ruralProperty}', [RuralPropertyController::class, 'destroy']);
    });

    Route::prefix('production-unit')->group(function(){
        Route::get('/', [ProductionUnitController::class, 'index']);
        Route::post('/', [ProductionUnitController::class, 'store']);
        Route::put('/{productionUnit}', [ProductionUnitController::class, 'update']);
        Route::delete('/{productionUnit}', [ProductionUnitController::class, 'destroy']);
    });

    Route::prefix('herd')->group(function(){
        Route::get('/', [HerdController::class, 'index']);
        Route::post('/', [HerdController::class, 'store']);
        Route::put('/{herd}', action: [HerdController::class, 'update']);
        Route::delete('/{herd}', [HerdController::class, 'destroy']);
    });
});

Route::post('login', [AuthController::class, 'login']);
