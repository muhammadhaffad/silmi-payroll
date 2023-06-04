<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TailorSalaryExport implements FromCollection, WithStyles
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
        $sheet->setCellValue('A1', 'STRUK GAJI PENJAHIT')
            ->setCellValue('A3', 'DETAIL PENJAHIT')
            ->setCellValue('A4', 'Nama : ' . $this->data->nama)
            ->setCellValue('A5', 'Bulan : ' . \Carbon\Carbon::parse($this->data->tanggal)->format('F Y'))
            ->setCellValue('C3', 'PEMBAYARAN')
            ->setCellValue('C4', 'Tgl Cetak : ' . date('Y-m-d'))
            ->setCellValue('C5', 'Take Home : ')
            ->setCellValue('C6', Helper::rupiah($this->data->gaji_final));
        $sheet->setCellValue('A8', 'RINCIAN JAHIT')
            ->setCellValue('A9', 'Nama')
            ->setCellValue('B9', 'Nominal')
            ->setCellValue('C9', 'Jumlah')
            ->setCellValue('D9', 'Sub Total');
        $totalNominal = 0;
        $totalQty = 0;
        foreach ($this->data->rincian_jahit as $key => $rincian) {
            $sheet->setCellValue(sprintf('A%u', $key + 10), $rincian['nama'])
                ->setCellValue(sprintf('B%u', $key + 10), $rincian['total'])
                ->setCellValue(sprintf('C%u', $key + 10), $rincian['qty'])
                ->setCellValue(sprintf('D%u', $key + 10), (int)$rincian['total']*(int)$rincian['qty']);
            $totalNominal += (int)$rincian['total']*(int)$rincian['qty'];
            $totalQty += (int)$rincian['qty'];
        }
        $sheet->setCellValue(sprintf('B%u', $key + 11), 'Total')
            ->setCellValue(sprintf('C%u', $key + 11), $totalQty)
            ->setCellValue(sprintf('D%u', $key + 11), $totalNominal);
        $sheet->setCellValue(sprintf('B%u', $key + 12), 'Komisi')
            ->setCellValue(sprintf('C%u', $key + 12), $this->data->kompensasi_persen)
            ->setCellValue(sprintf('D%u', $key + 12), $this->data->kompensasi);
        $sheet->setCellValue(sprintf('B%u', $key + 13), 'Total Jahit')
            ->setCellValue(sprintf('D%u', $key + 13), $this->data->total_gaji_after_kompensasi);
        $sheet->setCellValue(sprintf('A%u', $key + 14), 'RINCIAN KEBUTUHAN JAHIT')
            ->setCellValue(sprintf('A%u', $key + 15), 'Nama')
            ->setCellValue(sprintf('B%u', $key + 15), 'Nominal')
            ->setCellValue(sprintf('C%u', $key + 15), 'Jumlah')
            ->setCellValue(sprintf('D%u', $key + 15), 'Sub Total');
        $totalQtyKebutuhan = 0;
        $totalNominalKebutuhan = 0;
        if (empty($this->data->rincian_kebutuhan_jahit)) {
            $sheet->setCellValue(sprintf('A%u', $key + 16), '-')
                ->setCellValue(sprintf('B%u', $key + 16), '-')
                ->setCellValue(sprintf('C%u', $key + 16), '-')
                ->setCellValue(sprintf('D%u', $key + 16), '-');
        } else {
            foreach ($this->data->rincian_kebutuhan_jahit as $key => $rincian) {
                $sheet->setCellValue(sprintf('A%u', $key + 16), $rincian['nama'])
                    ->setCellValue(sprintf('B%u', $key + 16), $rincian['total'])
                    ->setCellValue(sprintf('C%u', $key + 16), $rincian['qty'])
                    ->setCellValue(sprintf('D%u', $key + 16), (int)$rincian['total']*(int)$rincian['qty']);
                $totalNominalKebutuhan += (int)$rincian['total']*(int)$rincian['qty'];
                $totalQtyKebutuhan += (int)$rincian['qty'];
            }
        }
        $sheet->setCellValue(sprintf('B%u', $key + 17), 'Total')
            ->setCellValue(sprintf('C%u', $key + 17), $totalQtyKebutuhan)
            ->setCellValue(sprintf('D%u', $key + 17), $totalNominalKebutuhan);
        $sheet->setCellValue(sprintf('B%u', $key + 18), 'Total Kebutuhan')
            ->setCellValue(sprintf('D%u', $key + 18), $this->data->total_kebutuhan);
        $sheet->setCellValue(sprintf('B%u', $key + 20), 'TOTAL GAJI')
            ->setCellValue(sprintf('D%u', $key + 20), $this->data->total_gaji_after_kebutuhan);
        $sheet->setCellValue(sprintf('B%u', $key + 21), 'KASUS')
            ->setCellValue(sprintf('C%u', $key + 21), $this->data->cacat_persen);
        $sheet->setCellValue(sprintf('B%u', $key + 22), 'KOMPENSASI KASUS')
            ->setCellValue(sprintf('C%u', $key + 22), $this->data->kompensasi_cacat_persen)
            ->setCellValue(sprintf('D%u', $key + 22), $this->data->kompensasi_cacat);
        $sheet->setCellValue(sprintf('B%u', $key + 23), 'BUBUT')
            ->setCellValue(sprintf('D%u', $key + 23), $this->data->bubut);
        $sheet->setCellValue(sprintf('B%u', $key + 24), 'CICILAN')
            ->setCellValue(sprintf('D%u', $key + 24), $this->data->cicilan);
        $sheet->setCellValue(sprintf('B%u', $key + 25), 'INFAQ')
            ->setCellValue(sprintf('D%u', $key + 25), $this->data->infaq);
        $sheet->setCellValue(sprintf('B%u', $key + 27), 'GAJI AKHIR')
            ->setCellValue(sprintf('D%u', $key + 27), $this->data->gaji_final);
    }
}
