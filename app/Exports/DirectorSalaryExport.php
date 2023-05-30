<?php

namespace App\Exports;

use App\Helpers\Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DirectorSalaryExport implements FromCollection, WithStyles
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return collect([]);
    }
    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
                    'color' => ['rgb' => '000'],
                ],
            ],
        ];
        $sheet->setCellValue('A1', 'STRUK GAJI DIREKSI')
            ->setCellValue('A3', 'DETAIL DIREKSI')
            ->setCellValue('A4', 'Nama Direksi : ' . $this->data->nama)
            ->setCellValue('A5', 'Total Gaji : ' . Helper::rupiah($this->data->take_home))
            ->setCellValue('C3', 'PEMBAYARAN')
            ->setCellValue('C4', 'Tgl Cetak : ' . date('Y-m-d'));
        $sheet->mergeCells('A1:C1');
        $sheet->mergeCells('A3:B3');
        $sheet->mergeCells('A4:B4');
        $sheet->mergeCells('A5:B5');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('C3')->getFont()->setBold(true)->setSize(18);
        $sheet->setCellValue('A6', 'Rincian Take Home : ')
            ->setCellValue('A7', 'Gaji Pokok')
            ->setCellValue('B7', 'Gaji Tambahan')
            ->setCellValue('C7', 'Total Gaji')
            ->setCellValue('A8', Helper::rupiah($this->data->gaji_pokok))
            ->setCellValue('B8', Helper::rupiah($this->data->gaji_tambahan))
            ->setCellValue('C8', Helper::rupiah($this->data->take_home));
        $sheet->getStyle('A7:C8')->applyFromArray($styleArray);
        $sheet->getStyle('A7:C8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getColumnDimension('A')->setWidth('18');
        $sheet->getColumnDimension('B')->setWidth('18');
        $sheet->getColumnDimension('C')->setWidth('18');
    }
}
