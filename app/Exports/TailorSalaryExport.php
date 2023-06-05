<?php

namespace App\Exports;

use App\Helpers\Helper;
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
        $sheet->getColumnDimension('A')->setWidth(24);
        $sheet->getColumnDimension('B')->setWidth(24);
        $sheet->getColumnDimension('C')->setWidth(24);
        $sheet->getColumnDimension('D')->setWidth(24);
        $sheet->setCellValue('A1', 'STRUK GAJI PENJAHIT')
            ->setCellValue('A3', 'DETAIL PENJAHIT')
            ->setCellValue('A4', 'Nama : ' . $this->data->nama)
            ->setCellValue('A5', 'Bulan : ' . \Carbon\Carbon::parse($this->data->tanggal)->format('F Y'))
            ->setCellValue('D3', 'PEMBAYARAN')
            ->setCellValue('D4', 'Tgl Cetak : ' . date('Y-m-d'))
            ->setCellValue('D5', 'Take Home : ')
            ->setCellValue('D6', Helper::rupiah($this->data->gaji_final));
        $sheet->mergeCells('A1:D1');
        $sheet->mergeCells('A3:B3');
        $sheet->mergeCells('A4:B4');
        $sheet->mergeCells('A5:B5');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(18);
        $sheet->setCellValue('A8', 'RINCIAN JAHIT')
            ->setCellValue('A9', 'Nama')
            ->setCellValue('B9', 'Nominal')
            ->setCellValue('C9', 'Jumlah')
            ->setCellValue('D9', 'Sub Total');
        $sheet->mergeCells('A8:D8');
        $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->getStyle('D3')->getFont()->setBold(true);
        $totalNominal = 0;
        $totalQty = 0;
        foreach ($this->data->rincian_jahit as $key => $rincian) {
            $sheet->setCellValue(sprintf('A%u', $key + 10), $rincian['sewing']['nama'])
                ->setCellValue(sprintf('B%u', $key + 10), Helper::rupiah($rincian['sewing']['total']))
                ->setCellValue(sprintf('C%u', $key + 10), $rincian['qty'])
                ->setCellValue(sprintf('D%u', $key + 10), Helper::rupiah((int)$rincian['sewing']['total']*(int)$rincian['qty']));
            $totalNominal += (int)$rincian['sewing']['total']*(int)$rincian['qty'];
            $totalQty += (int)$rincian['qty'];
        }
        $sheet->getStyle('A9:D9')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A9:D9')->getFont()->setBold(true);
        $sheet->getStyle(sprintf('A%u:D%u', 9, $key + 10))->applyFromArray($styleArray);
        $sheet->setCellValue(sprintf('B%u', $key + 11), 'Total')
            ->setCellValue(sprintf('C%u', $key + 11), $totalQty)
            ->setCellValue(sprintf('D%u', $key + 11), Helper::rupiah($totalNominal));
        $sheet->setCellValue(sprintf('B%u', $key + 12), 'Komisi')
            ->setCellValue(sprintf('C%u', $key + 12), $this->data->kompensasi_persen . '%')
            ->setCellValue(sprintf('D%u', $key + 12), Helper::rupiah($this->data->kompensasi));
        $sheet->setCellValue(sprintf('B%u', $key + 13), 'Total Jahit')
            ->setCellValue(sprintf('D%u', $key + 13), Helper::rupiah($this->data->total_gaji_after_kompensasi));
        $sheet->getStyle(sprintf('B%u:B%u', $key+11, $key+13))->getFont()->setBold(true);
        $sheet->mergeCells(sprintf('B%u:C%u', $key + 13, $key + 13));
        $sheet->getStyle(sprintf('B%u:D%u', $key + 11, $key + 13))->applyFromArray($styleArray);
        $sheet->setCellValue(sprintf('A%u', $key + 15), 'RINCIAN KEBUTUHAN JAHIT')
            ->setCellValue(sprintf('A%u', $key + 16), 'Nama')
            ->setCellValue(sprintf('B%u', $key + 16), 'Nominal')
            ->setCellValue(sprintf('C%u', $key + 16), 'Jumlah')
            ->setCellValue(sprintf('D%u', $key + 16), 'Sub Total');
        $tableStartKebutuhan = $key + 16;
        $sheet->mergeCells(sprintf('A%u:D%u', $key + 15, $key + 15));
        $totalQtyKebutuhan = 0;
        $totalNominalKebutuhan = 0;
        if (empty($this->data->rincian_kebutuhan_jahit)) {
            $sheet->setCellValue(sprintf('A%u', $key + 18), '-')
                ->setCellValue(sprintf('B%u', $key + 18), '-')
                ->setCellValue(sprintf('C%u', $key + 18), '-')
                ->setCellValue(sprintf('D%u', $key + 18), '-');
        } else {
            foreach ($this->data->rincian_kebutuhan_jahit as $key => $rincian) {
                $sheet->setCellValue(sprintf('A%u', $key + 18), $rincian['sewing_supply']['nama'])
                    ->setCellValue(sprintf('B%u', $key + 18), Helper::rupiah($rincian['sewing_supply']['harga']))
                    ->setCellValue(sprintf('C%u', $key + 18), $rincian['qty'])
                    ->setCellValue(sprintf('D%u', $key + 18), Helper::rupiah((int)$rincian['sewing_supply']['harga']*(int)$rincian['qty']));
                $totalNominalKebutuhan += (int)$rincian['sewing_supply']['harga']*(int)$rincian['qty'];
                $totalQtyKebutuhan += (int)$rincian['qty'];
            }
        }
        $tableEndKebutuhan = $key + 18;
        $sheet->getStyle(sprintf('A%u:D%u', $tableStartKebutuhan, $tableEndKebutuhan))->applyFromArray($styleArray);
        $sheet->getStyle(sprintf('A%u:D%u', $tableStartKebutuhan, $tableStartKebutuhan))->getAlignment()->setHorizontal('center');
        $sheet->getStyle(sprintf('A%u:D%u', $tableStartKebutuhan, $tableStartKebutuhan))->getFont()->setBold(true);
        $sheet->setCellValue(sprintf('B%u', $key + 19), 'Total')
            ->setCellValue(sprintf('C%u', $key + 19), $totalQtyKebutuhan)
            ->setCellValue(sprintf('D%u', $key + 19), Helper::rupiah($totalNominalKebutuhan));
        $sheet->setCellValue(sprintf('B%u', $key + 20), 'Total Kebutuhan')
            ->setCellValue(sprintf('D%u', $key + 20), Helper::rupiah($this->data->total_kebutuhan));
        $sheet->getStyle(sprintf('B%u:D%u', $key+19, $key+20))->applyFromArray($styleArray);
        $sheet->mergeCells(sprintf('B%u:C%u', $key + 20, $key + 20));
        $sheet->setCellValue(sprintf('B%u', $key + 22), 'TOTAL GAJI')
            ->setCellValue(sprintf('D%u', $key + 22), Helper::rupiah($this->data->total_gaji_after_kebutuhan));
        $sheet->setCellValue(sprintf('B%u', $key + 23), 'KASUS')
            ->setCellValue(sprintf('C%u', $key + 23), $this->data->cacat_persen . '%');
        $sheet->setCellValue(sprintf('B%u', $key + 24), 'KOMPENSASI KASUS')
            ->setCellValue(sprintf('C%u', $key + 24), $this->data->kompensasi_cacat_persen . '%')
            ->setCellValue(sprintf('D%u', $key + 24), Helper::rupiah($this->data->kompensasi_cacat));
        $sheet->setCellValue(sprintf('B%u', $key + 25), 'BUBUT')
            ->setCellValue(sprintf('D%u', $key + 25), Helper::rupiah($this->data->bubut));
        $sheet->setCellValue(sprintf('B%u', $key + 26), 'CICILAN')
            ->setCellValue(sprintf('D%u', $key + 26), Helper::rupiah($this->data->cicilan));
        $sheet->setCellValue(sprintf('B%u', $key + 27), 'INFAQ')
            ->setCellValue(sprintf('D%u', $key + 27), Helper::rupiah($this->data->infaq));
        $sheet->setCellValue(sprintf('B%u', $key + 29), 'GAJI AKHIR')
            ->setCellValue(sprintf('D%u', $key + 29), Helper::rupiah($this->data->gaji_final));
        $sheet->getStyle(sprintf('B%u:B%u', $key + 19, $key+29))->getFont()->setBold(true);
    }
}
