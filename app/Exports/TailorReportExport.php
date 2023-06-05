<?php

namespace App\Exports;

use App\Helpers\Helper;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TailorReportExport implements FromCollection, WithStyles
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
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
        $sheet->getColumnDimension('A')->setWidth(4);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(16);
        $sheet->getColumnDimension('D')->setWidth(16);
        $sheet->getColumnDimension('E')->setWidth(16);
        $sheet->getColumnDimension('F')->setWidth(16);
        $sheet->getColumnDimension('G')->setWidth(16);
        $sheet->setCellValue('A1', 'LAPORAN GAJI PENJAHIT')
            ->setCellValue('A2', sprintf('Bulan %s Tahun %u', Carbon::parse($this->data->first()->tanggal)->format('F'), Carbon::parse($this->data->first()->tanggal)->format('Y')));
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A4', 'No')
            ->setCellValue('B4', 'Nama')
            ->setCellValue('C4', 'Gaji')
            ->setCellValue('D4', 'Bubut')
            ->setCellValue('E4', 'Cicilan')
            ->setCellValue('F4', 'Infaq')
            ->setCellValue('G4', 'Gaji Akhir');
        $gajiFinalTotal = 0;
        $gajiTotal = 0;
        $bubutTotal = 0;
        $infaqTotal = 0;
        $cicilanTotal = 0;
        foreach ($this->data as $key => $row) {
            $sheet->setCellValue(sprintf('A%u', $key + 5), $key + 1)
                ->setCellValue(sprintf('B%u', $key + 5), $row->nama)
                ->setCellValue(sprintf('C%u', $key + 5), Helper::rupiah($row->gaji_final - $row->bubut + $row->infaq + $row->cicilan))
                ->setCellValue(sprintf('D%u', $key + 5), Helper::rupiah($row->bubut))
                ->setCellValue(sprintf('E%u', $key + 5), Helper::rupiah($row->cicilan))
                ->setCellValue(sprintf('F%u', $key + 5), Helper::rupiah($row->infaq))
                ->setCellValue(sprintf('G%u', $key + 5), Helper::rupiah($row->gaji_final));
            $gajiTotal += $row->gaji_final - $row->bubut + $row->infaq + $row->cicilan;
            $bubutTotal += $row->bubut;
            $cicilanTotal += $row->cicilan;
            $infaqTotal += $row->infaq;
            $gajiFinalTotal += $row->gaji_final;
        }
        $sheet->setCellValue(sprintf('A%u', $key + 5), '')
            ->setCellValue(sprintf('B%u', $key + 5), 'Total')
            ->setCellValue(sprintf('C%u', $key + 5), Helper::rupiah($gajiTotal))
            ->setCellValue(sprintf('D%u', $key + 5), Helper::rupiah($bubutTotal))
            ->setCellValue(sprintf('E%u', $key + 5), Helper::rupiah($cicilanTotal))
            ->setCellValue(sprintf('F%u', $key + 5), Helper::rupiah($infaqTotal))
            ->setCellValue(sprintf('G%u', $key + 5), Helper::rupiah($gajiFinalTotal));
        $sheet->getStyle(sprintf('A%u:G%u', 4, $key+5))->applyFromArray($styleArray);
        $sheet->getStyle(sprintf('A%u:G%u', 4, 4))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:G%u', 4, 4))->getAlignment()->setHorizontal('center');
        $sheet->getStyle(sprintf('A%u:G%u', $key + 5, $key + 5))->getFont()->setBold(true);
    }
}
