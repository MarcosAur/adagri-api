<?php

namespace App\Services\Overview;

use App\Models\Herd;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class GeneratePdfReportService
{
    public function run()
    {
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

        $filename = $now.'.pdf'; 

        $pdf->save($filename, 'public');
        return $filename;
    }
}