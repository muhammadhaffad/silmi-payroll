<?php

namespace App\Services\Report;

use App\Models\Devision;
use App\Models\Director;
use App\Models\Employee;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportService
{
    public function getDirectorSalaries()
    {
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => Director::select(['*', DB::raw('gaji+gaji_tambahan AS total')])->get()
        ];
    }
    public function getAllDevisionSalaries()
    {
        $startDate = Carbon::now()->subMonth()->format('Y-m-29');
        $endDate = Carbon::now()->format('Y-m-28');
        $devisionTotalSalaries = Devision::with(['employees' => function ($query) use ($startDate, $endDate) {
            $query->withSum(['attendanceLogs' => function($q) use ($startDate, $endDate) {
                $q->where('tanggal', '>=', $startDate)->where('tanggal', '<=', $endDate); /* $q->where('tanggal_expired', '>=', date('Y-m-d')); */
            }], 'total_jam')->with(['fixedAllowance', 'variableAllowance']);
        }])->get();
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $devisionTotalSalaries
        ];
    }
    public function getReport($devision, $year, $month)
    {
        $report = Report::where('devisi', $devision)->where('tanggal', "$year-$month-01");
        if ($report->count() > 0) {
            return [
                'code' => 200,
                'message' => 'Berhasil mendapatkan laporan',
                'data' => $report->get()
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Laporan tidak tersedia'
            ];
        }   
    }
    public function makeReport()
    {
        $startDate = Carbon::now()->subMonth()->format('Y-m-29');
        $endDate = Carbon::now()->format('Y-m-28');
        $devisions = Devision::with(['employees' => function ($query) use ($startDate, $endDate) {
            $query->withSum(['attendanceLogs' => function($q) use($startDate, $endDate) {
                $q->where('tanggal', '>=', $startDate)->where('tanggal', '<=', $endDate);
            }], 'total_jam')->with(['expertiseAllowances:employee_nip,nama,jumlah', 'fixedAllowance', 'variableAllowance']);
        }])->get();
        $directors = Director::select(['*', DB::raw('gaji+gaji_tambahan AS total')])->get();
        $count = Report::where('tanggal', date('Y-m-01'))->count();
        if ($count > 0) {
            $directorNames = Report::query()->where('tanggal', date('Y-m-01'))->where('devisi', 'DIREKSI')->get('nama')->pluck('nama');
            $namesTobeRemoved = $directorNames->diff($directors->pluck('nama'));
            $reportRemoved = Report::whereIn('nip', $namesTobeRemoved);
            foreach ($directors as $director) {
                Report::updateOrCreate(['nama' => $director->nama],[
                    'tanggal' => date('Y-m-01'),
                    'devisi' => 'DIREKSI',
                    'nip' => 0,
                    'nama' => $director->nama,
                    'jabatan' => 'DIREKSI',
                    'is_khusus' => true,
                    'gaji_pokok' => $director->gaji,
                    'gaji_tambahan' => $director->gaji_tambahan,
                    'take_home' => $director->total
                ]);
            }
            foreach ($devisions as $devision) {
                $nips = Report::query()->where('tanggal', date('Y-m-01'))->where('devisi', $devision->nama)->get('nip')->pluck('nip');
                $nipsToBeRemoved = $nips->diff($devision->employees->pluck('nip'));
                $reportRemoved = Report::whereIn('nip', $nipsToBeRemoved);
                foreach ($devision->employees as $employee) {
                    $tunjanganTidakTetap = 0;
                    if (!$employee->is_khusus) {
                        $tunjanganTidakTetap = $employee->variableAllowance->perjam * $employee->attendance_logs_sum_total_jam;
                    } else {
                        $tunjanganTidakTetap = $employee->variableAllowance->gaji_pokok + $employee->variableAllowance->tunjangan_jabatan;
                    }
                    $tunjanganTetap = $employee->fixedAllowance?->total;
                    Report::updateOrCreate([ 'nip' => $employee->nip ],
                    [
                        'tanggal' => date('Y-m-01'),
                        'devisi' => $devision->nama,
                        'nama' => $employee->nama,
                        'jabatan' => $employee->jabatan,
                        'is_khusus' => $employee->is_khusus,
                        'gaji_pokok' => $employee->variableAllowance->gaji_pokok ?? 0,
                        'tunjangan_jabatan' => $employee->variableAllowance->tunjangan_jabatan ?? 0,
                        'perjam' => $employee->variableAllowance->perjam ?? 0,
                        'total_jam' => $employee->attendance_logs_sum_total_jam ?? 0,
                        'total' => $tunjanganTidakTetap ?? 0,
                        'rincian_keahlian' => $employee->expertiseAllowances,
                        'tunjangan_keahlian' => $employee->fixedAllowance?->keahlian ?? 0,
                        'tunjangan_kepala_keluarga' => $employee->fixedAllowance?->kepala_keluarga ?? 0,
                        'tunjangan_masa_kerja' => $employee->fixedAllowance?->masa_kerja ?? 0,
                        'tunjangan_operasional' => $employee->fixedAllowance?->operasional ?? 0,
                        'tunjangan_lain_lain' => $employee->fixedAllowance?->lain_lain ?? 0,
                        'lembur' => $employee->fixedAllowance?->lembur ?? 0,
                        'reward' => $employee->fixedAllowance?->reward ?? 0,
                        'infaq' => $employee->fixedAllowance?->infaq ?? 0,
                        'cicilan' => $employee->fixedAllowance?->cicilan ?? 0,
                        'take_home' => $tunjanganTetap + $tunjanganTidakTetap ?? 0
                    ]);
                }
            }
        } else {
            foreach ($directors as $director) {
                Report::create([
                    'tanggal' => date('Y-m-01'),
                    'devisi' => 'DIREKSI',
                    'nip' => 0,
                    'nama' => $director->nama,
                    'jabatan' => 'DIREKSI',
                    'is_khusus' => 1,
                    'gaji_pokok' => $director->gaji,
                    'gaji_tambahan' => $director->gaji_tambahan,
                    'take_home' => $director->total
                ]);
            }
            foreach ($devisions as $devision) {
                foreach ($devision->employees as $key => $employee) {
                    $tunjanganTidakTetap = 0;
                    if (!$employee->is_khusus) {
                        $tunjanganTidakTetap = $employee->variableAllowance->perjam * $employee->attendance_logs_sum_total_jam;
                    } else {
                        $tunjanganTidakTetap = $employee->variableAllowance->gaji_pokok + $employee->variableAllowance->tunjangan_jabatan;
                    }
                    $tunjanganTetap = $employee->fixedAllowance?->total;
                    /* $tunjanganTetap = ($employee->fixedAllowance?->keahlian ?? 0) + 
                    ($employee->fixedAllowance?->kepala_keluarga ?? 0) + 
                    ($employee->fixedAllowance?->masa_kerja ?? 0) + 
                    ($employee->fixedAllowance?->operasional ?? 0) + 
                    ($employee->fixedAllowance?->lain_lain ?? 0) + 
                    ($employee->fixedAllowance?->lembur ?? 0) + 
                    ($employee->fixedAllowance?->reward ?? 0) - 
                    ($employee->fixedAllowance?->infaq ?? 0) - 
                    ($employee->fixedAllowance?->cicilan ?? 0); */
                    Report::create([
                        'tanggal' => date('Y-m-01'),
                        'devisi' => $devision->nama,
                        'nip' => $employee->nip,
                        'nama' => $employee->nama,
                        'jabatan' => $employee->jabatan,
                        'is_khusus' => $employee->is_khusus,
                        'gaji_pokok' => $employee->variableAllowance->gaji_pokok ?? 0,
                        'tunjangan_jabatan' => $employee->variableAllowance->tunjangan_jabatan ?? 0,
                        'perjam' => $employee->variableAllowance->perjam ?? 0,
                        'total_jam' => $employee->attendance_logs_sum_total_jam ?? 0,
                        'total' => $tunjanganTidakTetap ?? 0,
                        'rincian_keahlian' => $employee->expertiseAllowances,
                        'tunjangan_keahlian' => $employee->fixedAllowance?->keahlian ?? 0,
                        'tunjangan_kepala_keluarga' => $employee->fixedAllowance?->kepala_keluarga ?? 0,
                        'tunjangan_masa_kerja' => $employee->fixedAllowance?->masa_kerja ?? 0,
                        'tunjangan_operasional' => $employee->fixedAllowance?->operasional ?? 0,
                        'tunjangan_lain_lain' => $employee->fixedAllowance?->lain_lain ?? 0,
                        'lembur' => $employee->fixedAllowance?->lembur ?? 0,
                        'reward' => $employee->fixedAllowance?->reward ?? 0,
                        'infaq' => $employee->fixedAllowance?->infaq ?? 0,
                        'cicilan' => $employee->fixedAllowance?->cicilan ?? 0,
                        'take_home' => $tunjanganTetap + $tunjanganTidakTetap ?? 0
                    ]);
                }
            }
        }
        $report = Report::where('tanggal', date('Y-m-01'))->get();
        return [
            'code' => 201,
            'message' => 'Report berhasil dibuat',
            'data' => $report
        ];
    }
    public function getDevisionSalaries($id)
    {
        $startDate = Carbon::now()->subMonth()->format('Y-m-29');
        $endDate = Carbon::now()->format('Y-m-28');
        $devisionTotalSalaries = Devision::where('id', $id)->with(['employees' => function ($query) use ($startDate, $endDate) {
            $query->withSum(['attendanceLogs' => function($q) use ($startDate, $endDate) {
                $q->where('tanggal', '>=', $startDate)->where('tanggal', '<=', $endDate);
            }], 'total_jam')->with(['fixedAllowance', 'variableAllowance']);
        }])->get();
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $devisionTotalSalaries
        ];
    }
    public function getAnnualDevisionSalary($year = null, $withMonth = false)
    {
        if ($year == null) {
            $year = date('Y');
        }
        if ($withMonth) {
            return [
                'code' => 200,
                'message' => 'Berhasil mendapatkan data',
                'data' => Report::select('devisi', DB::raw('MONTH(tanggal) AS bulan'), DB::raw('SUM(take_home) AS jumlah'))->whereYear('tanggal', $year)->groupBy(DB::raw('MONTH(tanggal)'), 'devisi')->get()
            ];
        } else {
            return [
                'code' => 200,
                'message' => 'Berhasil mendapatkan data',
                'data' => Report::select(DB::raw('SUM(take_home) AS jumlah'))->whereYear('tanggal', $year)->groupBy('devisi')->get()
            ];
        }
    }
}
