<?php

namespace App\Http\Controllers;

use App\Services\Overview\GenerateDashboardService;
use App\Services\Overview\GeneratePdfReportService;
use App\Services\Overview\GenerateXlsxReportService;
use Illuminate\Support\Facades\Storage;

class OverviewController extends Controller
{
    public function pdfreport(GeneratePdfReportService $generatePdfReportService){
        $filename = $generatePdfReportService->run();
        return Storage::disk('public')->url($filename);
    }

    public function xlsxReport(GenerateXlsxReportService $generateXlsxReportService){
        
        $filename = $generateXlsxReportService->run();
        return Storage::disk('public')->url($filename);
    }

    public function generatedashboardsReport(GenerateDashboardService $generateChartReportService){

        $valueToReturn = $generateChartReportService->run();
        return $valueToReturn;
    }
}
