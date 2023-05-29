<?php

namespace App\Exports;

use App\Helpers\Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalaryKhususExport implements FromCollection, WithStyles
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
        $sheet->setCellValue('A1', 'STRUK GAJI KARYAWAN')
            ->setCellValue('A3', 'DETAIL KARYAWAN')
            ->setCellValue('A4', 'Nama Karyawan : ' . $this->data->nama)
            ->setCellValue('A5', 'Jabatan : ' . $this->data->jabatan)
            ->setCellValue('A6', 'Total Gaji : ' . Helper::rupiah($this->data->gaji_pokok + $this->data->tunjangan_jabatan + $this->data->reward + $this->data->lembur - $this->data->infaq - $this->data->cicilan))
            ->setCellValue('E3', 'PEMBAYARAN')
            ->setCellValue('E4', 'Tgl Cetak : ' . date('Y-m-d'));
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A3:D3');
        $sheet->mergeCells('A4:D4');
        $sheet->mergeCells('A5:D5');
        $sheet->mergeCells('A6:D6');
        $sheet->mergeCells('E3:F3');
        $sheet->mergeCells('E4:F4');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('E3')->getFont()->setBold(true)->setSize(18);
        $sheet->setCellValue('A8', 'Rincian Lembur : ')
        ->setCellValue('A9', 'Lembur')
        ->setCellValue('B9', 'Perjam')
        ->setCellValue('D9', 'Lembur (Jam)')
        ->setCellValue('F9', 'Total')
        ->setCellValue('B10', Helper::rupiah($this->data->perjam))
        ->setCellValue('D10', $this->data->lembur / $this->data->perjam)
        ->setCellValue('F10', Helper::rupiah($this->data->lembur));
        $sheet->getStyle('A9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A10')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('A8:C8');
        $sheet->mergeCells('A9:A10');
        $sheet->mergeCells('B9:C9');
        $sheet->mergeCells('B10:C10');
        $sheet->mergeCells('D9:E9');
        $sheet->mergeCells('D10:E10');
        $sheet->setCellValue('A12', 'Rincian Take Home : ')
            ->setCellValue('A13', 'Gaji Pokok')
            ->setCellValue('B13', 'Reward')
            ->setCellValue('C13', 'Lembur')
            ->setCellValue('D13', 'Infaq')
            ->setCellValue('E13', 'Cicilan')
            ->setCellValue('F13', 'Total')
            ->setCellValue('A14', Helper::rupiah($this->data->gaji_pokok + $this->data->tunjangan_jabatan))
            ->setCellValue('B14', Helper::rupiah($this->data->reward))
            ->setCellValue('C14', Helper::rupiah($this->data->lembur))
            ->setCellValue('D14', Helper::rupiah($this->data->infaq))
            ->setCellValue('E14', Helper::rupiah($this->data->cicilan))
            ->setCellValue('F14', Helper::rupiah($this->data->gaji_pokok + $this->data->tunjangan_jabatan + $this->data->reward + $this->data->lembur - $this->data->infaq - $this->data->cicilan));
        $sheet->mergeCells('A12:C12');
        $sheet->getStyle('A9:F10')->applyFromArray($styleArray);
        $sheet->getStyle('A9:F10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A13:F14')->applyFromArray($styleArray);
        $sheet->getStyle('A13:F14')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getColumnDimension('A')->setWidth('18');
        $sheet->getColumnDimension('B')->setWidth('18');
        $sheet->getColumnDimension('C')->setWidth('18');
        $sheet->getColumnDimension('D')->setWidth('18');
        $sheet->getColumnDimension('E')->setWidth('18');
        $sheet->getColumnDimension('F')->setWidth('18');
    }
}
