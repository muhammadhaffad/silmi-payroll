<?php

namespace App\Imports;

use App\Models\AttendanceLog;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AttendanceLogsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $scan1 = \Carbon\Carbon::parse($row['scan_1']);
        $scan2 = \Carbon\Carbon::parse($row['scan_2']);
        $scan3 = \Carbon\Carbon::parse($row['scan_3']);
        $scan4 = \Carbon\Carbon::parse($row['scan_4']);
        if ($row['scan_2'] && $row['scan_3']) {
            $in = strtotime($row['scan_1']);
            $startBreak = strtotime($row['scan_2']);
            $endBreak = strtotime($row['scan_3']);
            $out = strtotime($row['scan_4']);
            $breakInterval = $endBreak-$startBreak;
            $workHours = $out - $in - $breakInterval;
        } else if ($row['scan_2'] && $row['scan_3'] == null) {
            $in = strtotime($row['scan_1']);
            $out = strtotime($row['scan_2']);
            $workHours = $out - $in;
        } else if ($row['scan_2'] == null && $row['scan_3']) {
            $in = strtotime($row['scan_3']);
            $out = strtotime($row['scan_4']);
            $workHours = $out - $in;
        }
        return new AttendanceLog([
            'employee_nip' => $row['nip'],
            'tanggal' => \Carbon\Carbon::createFromFormat("d/m/Y", $row['tanggal'])->format('Y-m-d'),
            'tanggal_expired' => \Carbon\Carbon::now()->addDays(28)->format('Y-m-d'),
            'scan_1' => $row['scan_1'] ? $scan1->format('H:i:s') : null,
            'scan_2' => $row['scan_2'] ? $scan2->format('H:i:s') : null,
            'scan_3' => $row['scan_3'] ? $scan3->format('H:i:s') : null,
            'scan_4' => $row['scan_4'] ? $scan4->format('H:i:s') : null,
            'jam' => (int) \Carbon\Carbon::parse($workHours)->format('H'),
            'menit' => (int) \Carbon\Carbon::parse($workHours)->format('i'),
            'total_jam' => $workHours / 3600,
        ]);
    }
    public function headingRow() : int
    {
        return 2;
    }
}
