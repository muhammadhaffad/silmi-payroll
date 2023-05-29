<?php

namespace App\Exports;

use App\Helpers\Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReportExport implements FromCollection, WithStyles, WithCustomStartCell
{
    protected $devision;
    protected $month;
    protected $year;
    protected $data;
    public function __construct($devision, $month, $year, $data)
    {
        $this->devision = $devision;
        $this->month = $month;
        $this->year = $year;
        $this->data = $data;
    }
    public function collection()
    {
        // Logika untuk mengambil data yang ingin diekspor
        // return User::all();
        return collect([]);
    }

    public function startCell(): string
    {
        return 'A10';
    }
    public function styles(Worksheet $sheet)
    {
        // Menentukan border untuk tabel
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
                    'color' => ['rgb' => '000'],
                ],
            ],
        ];
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $this->month = $months[$this->month];
        $this->devision = ucfirst(strtolower($this->devision));
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->setCellValue('A1', "Laporan Rekap Gaji Devisi $this->devision");
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->setCellValue('A2', "Bulan $this->month Tahun $this->year");
        $sheet->getStyle('A2')->getFont()->setSize(14);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->setCellValue('A4', "Detail");
        $sheet->getStyle('A4')->getFont()->setBold(true);
        $sheet->setCellValue('A5', "Tanggal Cetak : " . date('Y-m-d'));
        $sheet->setCellValue('A6', "Periode : $this->month $this->year");
        $sheet->mergeCells('A1:O1', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->mergeCells('A2:O2', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->mergeCells('A4:O4', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->mergeCells('A5:O5', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->mergeCells('A6:O6', Worksheet::MERGE_CELL_CONTENT_MERGE);

        $sheet->setCellValue('A8', "No");
        $sheet->mergeCells('A8:A9', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->getColumnDimension('A')->setWidth(4 );
        $sheet->setCellValue('B8', "Nama");
        $sheet->mergeCells('B8:B9', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->getColumnDimension('B')->setWidth(16);
        $sheet->setCellValue('C8', "TUNJANGAN TIDAK TETAP");
        $sheet->mergeCells('C8:G8', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->setCellValue('C9', "Gaji Pokok");
        $sheet->getColumnDimension('C')->setWidth(16);
        $sheet->setCellValue('D9', "T. Jabatan");
        $sheet->getColumnDimension('D')->setWidth(16);
        $sheet->setCellValue('E9', "Perjam");
        $sheet->getColumnDimension('E')->setWidth(16);
        $sheet->setCellValue('F9', "Jam");
        $sheet->getColumnDimension('F')->setWidth(16);
        $sheet->setCellValue('G9', "Total");
        $sheet->getColumnDimension('G')->setWidth(16);
        $sheet->setCellValue('H8', "TUNJANGAN TETAP");
        $sheet->mergeCells('H8:N8', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->setCellValue('H9', "T. Keahlian");
        $sheet->getColumnDimension('H')->setWidth(16);
        $sheet->setCellValue('I9', "T. Kepala Keluarga");
        $sheet->getColumnDimension('I')->setWidth(16);
        $sheet->setCellValue('J9', "T. Masa Kerja");
        $sheet->getColumnDimension('J')->setWidth(16);
        $sheet->setCellValue('K9', "Lembur");
        $sheet->getColumnDimension('K')->setWidth(16);
        $sheet->setCellValue('L9', "Reward");
        $sheet->getColumnDimension('L')->setWidth(16);
        $sheet->setCellValue('M9', "Infaq");
        $sheet->getColumnDimension('M')->setWidth(16);
        $sheet->setCellValue('N9', "Cicilan");
        $sheet->getColumnDimension('N')->setWidth(16);
        $sheet->setCellValue('O8', "Take Home");
        $sheet->getColumnDimension('O')->setWidth(16);
        $sheet->mergeCells('O8:O9', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->getStyle('A8:O9')->applyFromArray($styleArray);
        $sheet->getStyle('A8:O9')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A8:O9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A8:O9')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $sheet->getStyle('A8:O9')->getFont()->setBold(true);
        $sheet->getRowDimension(8)->setRowHeight(40);
        $sheet->getRowDimension(9)->setRowHeight(40);

        $totalGajiPokok = 0;
        $totalTJabatan = 0;
        $totalPerjam = 0;
        $totalJam = 0;
        $totalTTidakTetap = 0;
        $totalTKeahlian = 0;
        $totalTKK = 0;
        $totalTMasaKerja = 0;
        $totalLembur = 0;
        $totalReward = 0;
        $totalInfaq = 0;
        $totalCicilan = 0;
        $totalTakeHome = 0;
        $key = 0;
        foreach ($this->data as $key => $data) {
            $sheet->setCellValue('A'.$key+10, $key+1);
            $sheet->setCellValue('B'.$key+10, ' '.$data->nama);
            $sheet->setCellValue('C'.$key+10, ' '.Helper::rupiah($data->gaji_pokok));
            $totalGajiPokok += $data->gaji_pokok;
            $sheet->setCellValue('D'.$key+10, ' ' . Helper::rupiah($data->tunjangan_jabatan));
            $totalTJabatan += $data->tunjangan_jabatan;
            $sheet->setCellValue('E'.$key+10, ' ' . Helper::rupiah($data->perjam));
            $totalPerjam += $data->perjam;
            $sheet->setCellValue('F'.$key+10, ' ' . number_format($data->total_jam, 2, ',', '.'));
            $totalJam += $data->total_jam;
            $sheet->setCellValue('G'.$key+10, ' ' . Helper::rupiah($data->total));
            $totalTTidakTetap += $data->total;
            $sheet->setCellValue('H'.$key+10, ' ' . Helper::rupiah($data->tunjangan_keahlian));
            $totalTKeahlian += $data->tunjangan_keahlian;
            $sheet->setCellValue('I'.$key+10, ' ' . Helper::rupiah($data->tunjangan_kepala_keluarga));
            $totalTKK += $data->tunjangan_kepala_keluarga;
            $sheet->setCellValue('J'.$key+10, ' ' . Helper::rupiah($data->tunjangan_masa_kerja));
            $totalTMasaKerja += $data->tunjangan_masa_kerja;
            $sheet->setCellValue('K'.$key+10, ' ' . Helper::rupiah($data->lembur));
            $totalLembur += $data->lembur;
            $sheet->setCellValue('L'.$key+10, ' ' . Helper::rupiah($data->reward));
            $totalReward += $data->reward;
            $sheet->setCellValue('M'.$key+10, ' ' . Helper::rupiah($data->infaq));
            $totalInfaq += $data->infaq;
            $sheet->setCellValue('N'.$key+10, ' ' . Helper::rupiah($data->cicilan));
            $totalCicilan += $data->cicilan;
            $sheet->setCellValue('O'.$key+10, ' ' . Helper::rupiah($data->take_home));
            $sheet->getRowDimension($key+10)->setRowHeight(20);
            $totalTakeHome += $data->take_home;
        }
        $sheet->mergeCells('A' . ($key+11) . ':B' . ($key+11));
        $sheet->setCellValue('A'.$key+11, ' Total');
        $sheet->setCellValue('C'.$key+11, ' ' . Helper::rupiah($totalGajiPokok));
        $sheet->setCellValue('D'.$key+11, ' ' . Helper::rupiah($totalTJabatan));
        $sheet->setCellValue('E'.$key+11, ' ' . Helper::rupiah($totalPerjam));
        $sheet->setCellValue('F'.$key+11, ' ' . number_format($totalJam, 2, ',', '.'));
        $sheet->setCellValue('G'.$key+11, ' ' . Helper::rupiah($totalTTidakTetap));
        $sheet->setCellValue('H'.$key+11, ' ' . Helper::rupiah($totalTKeahlian ));
        $sheet->setCellValue('I'.$key+11, ' ' . Helper::rupiah($totalTKK ));
        $sheet->setCellValue('J'.$key+11, ' ' . Helper::rupiah($totalTMasaKerja));
        $sheet->setCellValue('K'.$key+11, ' ' . Helper::rupiah($totalLembur));
        $sheet->setCellValue('L'.$key+11, ' ' . Helper::rupiah($totalReward));
        $sheet->setCellValue('M'.$key+11, ' ' . Helper::rupiah($totalInfaq));
        $sheet->setCellValue('N'.$key+11, ' ' . Helper::rupiah($totalCicilan));
        $sheet->setCellValue('O'.$key+11, ' ' . Helper::rupiah($totalTakeHome));
        $sheet->getRowDimension($key+11)->setRowHeight(20);
        $sheet->getStyle('A' . ($key+11) . ':O' . ($key+11))->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB(Color::COLOR_YELLOW);
        $sheet->getStyle('A10:O'.$key+11)->applyFromArray($styleArray);
        $sheet->getStyle('A10:O'.$key+11)->getAlignment()->setIndent(4);
        $sheet->getStyle('A10:O'.$key+11)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    }
}
