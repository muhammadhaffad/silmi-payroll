<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class UserExport implements FromCollection, WithStyles, WithCustomStartCell
{
    protected $devision;
    protected $month;
    protected $year;
    public function __construct($devision, $month, $year)
    {
        $this->devision = $devision;
        $this->month = $month;
        $this->year = $year;
    }
    public function collection()
    {
        // Logika untuk mengambil data yang ingin diekspor
        // return User::all();
        return collect([
            ['John Doe', 'johndoe@example.com'],
            ['Jane Smith', 'janesmith@example.com'],
        ]);
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
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->setCellValue('A1', "Laporan Rekap Gaji Devisi $this->devision");
        $sheet->setCellValue('A2', "Bulan $this->month Tahun $this->year");
        $sheet->setCellValue('A4', "Detail");
        $sheet->setCellValue('A5', "Tanggal Cetak : " . date('Y-m-d'));
        $sheet->setCellValue('A6', "Periode : $this->month $this->year");
        $sheet->mergeCells('A1:F1', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->mergeCells('A2:F2', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->mergeCells('A4:F4', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->mergeCells('A5:F5', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->mergeCells('A6:F6', Worksheet::MERGE_CELL_CONTENT_MERGE);

        $sheet->setCellValue('A8', "No");
        $sheet->mergeCells('A8:A9', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->getColumnDimension('A')->setWidth(1);
        $sheet->setCellValue('B8', "Nama");
        $sheet->mergeCells('B8:B9', Worksheet::MERGE_CELL_CONTENT_MERGE);
        $sheet->getColumnDimension('B')->setWidth(6);
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
    }
}
