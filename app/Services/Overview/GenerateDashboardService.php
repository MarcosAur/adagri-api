<?php

namespace App\Services\Overview;

use App\Models\Herd;
use App\Models\ProductionUnit;
use App\Models\RuralProperty;

class GenerateDashboardService
{
    public function run()
    {
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
    }
}

