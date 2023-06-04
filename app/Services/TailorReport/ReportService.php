<?php
namespace App\Services\TailorReport;

use App\Models\Tailor\Employee;
use App\Models\Tailor\Report;

class ReportService 
{
    public function makeReport()
    {
        $employees = Employee::withSum('sewingTasks', 'total')->withSum('sewingNeeds', 'total')->with('infaq', 'installment', 'trimming', 'sewingTasks', 'sewingNeeds', 'sewingDefect', 'sewingCompensation', 'sewingCompensationRules')->get();
        if (Report::where('tanggal', date('Y-m-01'))->count() > 0) {
            $tailorNames = Report::where('tanggal', date('Y-m-01'))->get('nama')->pluck('nama');
            $namesTobeRemoved = $tailorNames->diff($employees->pluck('nama'));
            $reportRemoved = Report::whereIn('nama', $namesTobeRemoved);
            $reportRemoved->delete();
            foreach ($employees as $employee) {
                Report::updateOrCreate(['nama' => $employee->nama], [
                    'tanggal' => date('Y-m-01'),
                    'rincian_jahit' => $employee->sewingTasks->toArray(),
                    'total_jahit' => $employee->sewing_tasks_sum_total,
                    'kompensasi_jahit' => $employee->sewingCompensation->kompensasi_persen,
                    'kompensasi' => (int)($employee->sewing_tasks_sum_total * $employee->sewingCompensation->kompensasi_persen / 100),
                    'total_gaji_after_kompensasi' => $employee->sewing_tasks_sum_total 
                        + (int)($employee->sewing_tasks_sum_total * $employee->sewingCompensation->kompensasi_persen / 100),
                    'rincian_kebutuhan_jahit' => $employee->sewingNeeds?->toArray() ?? [],
                    'total_kebutuhan' => ($employee->sewing_needs_sum_total ?? 0),
                    'total_gaji_after_kebutuhan' => $employee->sewing_tasks_sum_total 
                        + (int)($employee->sewing_tasks_sum_total * $employee->sewingCompensation->kompensasi_persen / 100)
                        - ($employee->sewing_needs_sum_total ?? 0),
                    'cacat_persen' => $employee->sewingDefect->cacat_persen,
                    'kompensasi_cacat_persen' => $employee->sewingDefect->kompensasi_persen,
                    'kompensasi_cacat' => (int)($employee->sewing_tasks_sum_total * $employee->sewingDefect->kompensasi_persen / 100),
                    'cicilan' => $employee->installment->jumlah,
                    'infaq' => $employee->infaq->jumlah,
                    'bubut' => $employee->trimming->jumlah,
                    'gaji_final' => $employee->sewing_tasks_sum_total 
                        + (int)($employee->sewing_tasks_sum_total * $employee->sewingCompensation->kompensasi_persen / 100) 
                        - ($employee->sewing_needs_sum_total ?? 0) 
                        + (int)($employee->sewing_tasks_sum_total * $employee->sewingDefect->kompensasi_persen / 100) 
                        + $employee->trimming->jumlah 
                        - $employee->infaq->jumlah 
                        - $employee->installment->jumlah
                ]);
            }
        } else {
            foreach ($employees as $employee) {
                Report::create([
                    'tanggal' => date('Y-m-01'),
                    'nama' => $employee->nama,
                    'rincian_jahit' => $employee->sewingTasks->toArray(),
                    'total_jahit' => $employee->sewing_tasks_sum_total,
                    'kompensasi_jahit' => $employee->sewingCompensation->kompensasi_persen,
                    'kompensasi' => (int)($employee->sewing_tasks_sum_total * $employee->sewingCompensation->kompensasi_persen / 100),
                    'total_gaji_after_kompensasi' => $employee->sewing_tasks_sum_total 
                        + (int)($employee->sewing_tasks_sum_total * $employee->sewingCompensation->kompensasi_persen / 100),
                    'rincian_kebutuhan_jahit' => $employee->sewingNeeds?->toArray() ?? [],
                    'total_kebutuhan' => ($employee->sewing_needs_sum_total ?? 0),
                    'total_gaji_after_kebutuhan' => $employee->sewing_tasks_sum_total 
                        + (int)($employee->sewing_tasks_sum_total * $employee->sewingCompensation->kompensasi_persen / 100)
                        - ($employee->sewing_needs_sum_total ?? 0),
                    'cacat_persen' => $employee->sewingDefect->cacat_persen,
                    'kompensasi_cacat_persen' => $employee->sewingDefect->kompensasi_persen,
                    'kompensasi_cacat' => (int)($employee->sewing_tasks_sum_total * $employee->sewingDefect->kompensasi_persen / 100),
                    'cicilan' => $employee->installment->jumlah,
                    'infaq' => $employee->infaq->jumlah,
                    'bubut' => $employee->trimming->jumlah,
                    'gaji_final' => $employee->sewing_tasks_sum_total 
                        + (int)($employee->sewing_tasks_sum_total * $employee->sewingCompensation->kompensasi_persen / 100) 
                        - ($employee->sewing_needs_sum_total ?? 0) 
                        + (int)($employee->sewing_tasks_sum_total * $employee->sewingDefect->kompensasi_persen / 100) 
                        + $employee->trimming->jumlah 
                        - $employee->infaq->jumlah 
                        - $employee->installment->jumlah
                ]);
            }
        }
        return [
            'code' => 200,
            'message' => 'Laporan bulan ini berhasil dibuat/diperbarui'
        ];
    }
    public function getReport($attr)
    {
        $report = Report::where('tanggal', date(sprintf('%u-%u-01', $attr['tahun'] ?? date('Y'), $attr['bulan'] ?? date('m'))))->get();
        return [
            'code' => 200,
            'message' => 'Sukses mendapatkan data',
            'data' => $report
        ];
    }
}