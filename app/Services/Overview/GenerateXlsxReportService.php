<?php

namespace App\Services\Overview;

use App\Exports\RuralPropertiesExport;
use App\Models\Herd;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class GenerateXlsxReportService
{
    public function run()
    {
        $now = Carbon::now()->format('d_m_Y_h_i_s');
        $filename = $now.'.xlsx';
        Excel::store(new RuralPropertiesExport, $filename, 'public');

        return $filename;
    }
}