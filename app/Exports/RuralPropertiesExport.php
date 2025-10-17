<?php

namespace App\Exports;

use App\Models\RuralProperty;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RuralPropertiesExport implements FromArray, WithStyles
{

    public function array(): array
    {
        $header = [
            ['Relatório de Propriedades']
        ];

        $headers =[
            ['Nome','Inscrição Estadual','Area Total','Produtor']
        ];

        $data = RuralProperty::join('producers', 'producers.id', '=', 'rural_properties.producer_id')
            ->select([
                'rural_properties.name as property_name',
                'rural_properties.state_registration as state_registration',
                'rural_properties.total_area as total_area',
                'producers.name as producer_name'
            ])->get()->toArray();
        
        return array_merge($header, $headers, $data);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:D1');

        $sheet->getStyle('A2:D2')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '111627'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);
    }

}