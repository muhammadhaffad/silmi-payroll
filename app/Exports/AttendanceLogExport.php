<?php

namespace App\Exports;

use App\Helpers\Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceLogExport implements FromCollection, WithStyles, WithCustomStartCell
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
    public function startCell(): string
    {
        return 'A7';
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->setCellValue('A1', 'Laporan GP/Jam');
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Nama Karyawan : ' . $this->data['employee']->nama);
        $sheet->setCellValue('A4', 'Jabatan : ' . $this->data['employee']->jabatan);
        $sheet->setCellValue('D3', 'Tanggal Cetak : ' . date('Y-m-d'));
        $sheet->mergeCells('D3:E3'); 
        $sheet->mergeCells('A3:C3'); 
        $sheet->mergeCells('A4:C4'); 
        $sheet->getStyle('D3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $sheet->setCellValue('A6', 'No');
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->setCellValue('B6', 'Tanggal');
        $sheet->getColumnDimension('B')->setWidth(22);
        $sheet->setCellValue('C6', 'GP');
        $sheet->getColumnDimension('C')->setWidth(22);
        $sheet->setCellValue('D6', 'Jam');
        $sheet->getColumnDimension('D')->setWidth(22);
        $sheet->setCellValue('E6', 'Total');
        $sheet->getColumnDimension('E')->setWidth(22);
        $sheet->getRowDimension(6)->setRowHeight(20);
        $sheet->getStyle('A6:E6')->getFont()->setBold(true);
        $total = 0;
        foreach ($this->data['logs'] as $key => $log) {
            $sheet->setCellValue("A".$key+7, $key+1);
            $sheet->setCellValue("B".$key+7, $log->tanggal);
            $sheet->setCellValue("C".$key+7, Helper::rupiah($this->data['employee']->variableAllowance->perjam));
            $sheet->setCellValue("D".$key+7, $log->total_jam);
            $sheet->getStyle("D".$key+7)->getNumberFormat()->setFormatCode('0.000" Jam"');
            $sheet->setCellValue("E".$key+7, Helper::rupiah($this->data['employee']->variableAllowance->perjam * $log->total_jam));
            $total += $this->data['employee']->variableAllowance->perjam * $log->total_jam;
        }
        $sheet->setCellValue('A'.$key+8, 'Total');
        $sheet->mergeCells('A'.($key+8).':D'.($key+8));
        $sheet->setCellValue('E'.$key+8, Helper::rupiah($total));
        $sheet->getStyle('A6:E'.$key+8)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A6:E'.$key+8)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A6:E'.$key+8)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
                    'color' => ['rgb' => '000'],
                ],
            ],
        ]);
    }
}
