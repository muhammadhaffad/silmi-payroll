<?php

namespace App\Exports;

use App\Helpers\Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DebtExport implements FromCollection, WithStyles
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
        $sheet->setCellValue('A1', 'SURAT CICILAN')
         ->setCellValue('A3', 'Nama Karyawan : ' . $this->data->employee->nama)
         ->setCellValue('A4', 'Jabatan : ' . $this->data->employee->jabatan)
         ->setCellValue('A5', 'Status Hutang : ' . ($this->data->sisa_hutang !== 0 ? 'Belum Lunas' : 'Sudah Lunas'))
         ->setCellValue('C3', 'Tanggal Cetak : ' . $this->data->tanggal)
         ->setCellValue('C4', 'Besaran Hutang : ' . Helper::rupiah($this->data->hutang))
         ->setCellValue('A7', ' TANGGAL')
         ->setCellValue('B7', ' URAIAN')
         ->setCellValue('C7', ' HUTANG')
         ->setCellValue('D7', ' CICILAN');
        $sheet->getColumnDimension('A')->setWidth(24);
        $sheet->getColumnDimension('B')->setWidth(24);
        $sheet->getColumnDimension('C')->setWidth(24);
        $sheet->getColumnDimension('D')->setWidth(24);
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(18);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('A3:B3');
        $sheet->mergeCells('A4:B4');
        $sheet->mergeCells('A5:B5');
        $sheet->mergeCells('C3:D3');
        $sheet->mergeCells('C4:D4');
        $sheet->setCellValue('A8', ' ' . $this->data->tanggal)
                ->setCellValue('B8', ' CASH')
                ->setCellValue('C8', ' ' . Helper::rupiah($this->data->hutang));
        $key = 0;
        foreach ($this->data->debtPayments as $key => $debtPayment) {
            $sheet->setCellValue('A'.($key+9), ' ' . $debtPayment->tanggal)
                ->setCellValue('B'.($key+9), ' CREDIT')
                ->setCellValue('D'.($key+9), ' ' . Helper::rupiah($debtPayment->cicilan));
        }
        // if ($key == 0) {
        //     $sheet->setCellValue('A'.($key+9), 'Belum Bayar Cicilan');
        //     $sheet->getStyle('A'.($key+9))->getAlignment()->setHorizontal('center');
        //     $sheet->mergeCells('A'.($key+9).':D'.($key+9));
        // }
        $sheet->setCellValue('A'.($key+10), ' ' . ' Total')
                ->setCellValue('C'.($key+10), ' ' . Helper::rupiah($this->data->hutang))
                ->setCellValue('D'.($key+10), ' ' . Helper::rupiah($this->data->hutang - $this->data->sisa_hutang));
        $sheet->setCellValue('A'.($key+11), ' ' . ' Sisa Hutang')
                ->setCellValue('C'.($key+11), ' ' . Helper::rupiah($this->data->sisa_hutang));
        $sheet->mergeCells('A' . ($key+10) . ':B' . ($key+10));
        $sheet->mergeCells('A' . ($key+11) . ':B' . ($key+11));
        $sheet->mergeCells('C' . ($key+11) . ':D' . ($key+11));
        $sheet->getStyle('A7:D'.($key+11))->applyFromArray($styleArray);
    }
}
