<?php

namespace App\Exports;

use App\Helpers\Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalaryNonKhususExport implements FromCollection, WithStyles
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
            ->setCellValue('B3', 'PEMBAYARAN')
            ->setCellValue('B4', 'Tgl Cetak : ' . date('Y-m-d'))
            ->setCellValue('B6', 'Take Home : ')
            ->setCellValue('B7', Helper::rupiah($this->data->take_home));
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('B3')->getFont()->setBold(true)->setSize(18);
        $sheet->setCellValue('A8', 'Total Tunjangan Tidak Tetap')
            ->setCellValue('A9', 'Tunjangan Tidak Tetap')
            ->setCellValue('A10', ' Gaji Pokok')
            ->setCellValue('A11', ' Tunjangan Jabatan')
            ->setCellValue('A12', ' Perjam')
            ->setCellValue('A13', ' Jumlah Jam')
            ->setCellValue('B9', ' Total')
            ->setCellValue('B10', ' ' . Helper::rupiah($this->data->gaji_pokok))
            ->setCellValue('B11', ' ' . Helper::rupiah($this->data->tunjangan_jabatan))
            ->setCellValue('B12', ' ' . Helper::rupiah($this->data->perjam))
            ->setCellValue('B13', ' ' . $this->data->total_jam)
            ->setCellValue('A14', 'Total')
            ->setCellValue('B14', ' ' . Helper::rupiah($this->data->total));
        $sheet->getStyle('A9:B14')->applyFromArray($styleArray);
        $sheet->getStyle('A9:B9')->getFont()->setBold(true);
        $sheet->getStyle('A9:B9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A14:B14')->getFont()->setBold(true);
        $sheet->getStyle('A14:B14')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        
        
        $key = 0;
        if ($this->data->devisi == 'SALES') {
            $sheet->setCellValue('A16', 'Total Tunjangan Tetap')
                ->setCellValue('A17', 'Tunjangan Operasional & Lain-lain')
                ->setCellValue('B17', 'Total')->getStyle('A17:B17')->getFont()->setBold(true);
            $sheet->getStyle('A17:B17')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('A'.($key+18), ' Operasional')
                ->setCellValue('B'.($key+18), ' ' . Helper::rupiah($this->data->tunjangan_operasional));
            $key++;
            $sheet->setCellValue('A'.($key+18), ' Lain-lain')
                ->setCellValue('B'.($key+18), ' ' . Helper::rupiah($this->data->tunjangan_lain_lain));
        } else {
            $sheet->setCellValue('A16', 'Total Tunjangan Tetap')
                ->setCellValue('A17', 'Tunjangan Keahlian')
                ->setCellValue('B17', 'Total')->getStyle('A17:B17')->getFont()->setBold(true);
            $sheet->getStyle('A17:B17')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            foreach ($this->data->rincian_keahlian as $key => $keahlian) {
                $sheet->setCellValue('A'.($key+18), ' '.$keahlian['nama'])
                    ->setCellValue('B'.($key+18), ' ' . Helper::rupiah($keahlian['jumlah']));
            }
            if ($this->data->rincian_keahlian == []) {
                $sheet->setCellValue('A'.($key+18), '-')
                        ->setCellValue('B'.($key+18), ' ' . Helper::rupiah(0));
            }
        }
        $sheet->setCellValue('A'.($key+19), 'Total')
            ->setCellValue('B'.($key+19), ' ' . Helper::rupiah(($this->data->devisi == 'SALES') ? ($this->data->tunjangan_operasional + $this->data->tunjangan_lain_lain) : $this->data->tunjangan_keahlian ));
        $sheet->getStyle('A'.($key+19).':B'.($key+19))->getFont()->setBold(true);
        $sheet->getStyle('A'.($key+19).':B'.($key+19))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $sheet->setCellValue('A'.($key+20), 'Tunjangan Kepala Keluarga')
            ->setCellValue('A'.($key+21), ' Tunjangan Kepala Keluarga')
            ->setCellValue('A'.($key+22), 'Total')
            ->setCellValue('A'.($key+23), 'Tunjangan Masa Kerja')
            ->setCellValue('A'.($key+24), ' Tunjangan Masa Kerja')
            ->setCellValue('A'.($key+25), 'Total')
            ->setCellValue('A'.($key+26), 'Jumlah Tunjangan')
            ->setCellValue('B'.($key+20), 'Total')
            ->setCellValue('B'.($key+21), ' ' . Helper::rupiah($this->data->tunjangan_kepala_keluarga))
            ->setCellValue('B'.($key+22), ' ' . Helper::rupiah($this->data->tunjangan_kepala_keluarga))
            ->setCellValue('B'.($key+23), 'Total')
            ->setCellValue('B'.($key+24), ' ' . Helper::rupiah($this->data->tunjangan_masa_kerja))
            ->setCellValue('B'.($key+25), ' ' . Helper::rupiah($this->data->tunjangan_masa_kerja))
            ->setCellValue('B'.($key+26), ' ' . Helper::rupiah(($this->data->devisi == 'SALES') ? ($this->data->tunjangan_operasional + $this->data->tunjangan_lain_lain + $this->data->tunjangan_kepala_keluarga + $this->data->tunjangan_masa_kerja) : ($this->data->tunjangan_keahlian + $this->data->tunjangan_kepala_keluarga + $this->data->tunjangan_masa_kerja)));
        $sheet->getStyle(sprintf('A%u:B%u', $key+20, $key+20))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+20, $key+20))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle(sprintf('A%u:B%u', $key+22, $key+22))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+22, $key+22))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle(sprintf('A%u:B%u', $key+25, $key+25))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+25, $key+25))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle(sprintf('A%u:B%u', $key+23, $key+23))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+23, $key+23))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle(sprintf('A%u:B%u', $key+26, $key+26))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+26, $key+26))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('A17:B'.($key+26))->applyFromArray($styleArray);
        
        $sheet->setCellValue('A'.($key+28), 'Total Reward & Lembur')
        ->setCellValue('A'.($key+29), 'Reward & Lembur')
        ->setCellValue('A'.($key+30), ' Reward')
        ->setCellValue('A'.($key+31), ' Lembur')
        ->setCellValue('A'.($key+32), 'Total')
        ->setCellValue('B'.($key+29), 'Total')
        ->setCellValue('B'.($key+30), ' ' . Helper::rupiah($this->data->reward))
        ->setCellValue('B'.($key+31), ' ' . Helper::rupiah($this->data->lembur))
        ->setCellValue('B'.($key+32), ' ' . Helper::rupiah($this->data->reward + $this->data->lembur));
        $sheet->getStyle(sprintf('A%u:B%u', $key+29, $key+29))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+29, $key+29))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle(sprintf('A%u:B%u', $key+32, $key+32))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+32, $key+32))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle(sprintf('A%u:B%u', $key+29, $key+32))->applyFromArray($styleArray);
        
        $sheet->setCellValue('A'.($key+34), 'Total Infaq & Cicilan')
        ->setCellValue('A'.($key+35), 'Infaq & Cicilan')
        ->setCellValue('A'.($key+36), ' Infaq')
        ->setCellValue('A'.($key+37), ' Cicilan')
        ->setCellValue('A'.($key+38), 'Total')
        ->setCellValue('B'.($key+35), 'Total')
        ->setCellValue('B'.($key+36), ' ' . Helper::rupiah($this->data->infaq))
        ->setCellValue('B'.($key+37), ' ' . Helper::rupiah($this->data->cicilan))
        ->setCellValue('B'.($key+38), ' ' . Helper::rupiah($this->data->infaq + $this->data->cicilan));
        $sheet->getStyle(sprintf('A%u:B%u', $key+35, $key+38))->applyFromArray($styleArray);
        $sheet->getStyle(sprintf('A%u:B%u', $key+35, $key+35))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+35, $key+35))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle(sprintf('A%u:B%u', $key+38, $key+38))->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:B%u', $key+38, $key+38))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getColumnDimension('A')->setWidth(80);
    }
}
