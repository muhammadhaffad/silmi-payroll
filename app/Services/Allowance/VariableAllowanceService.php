<?php
namespace App\Services\Allowance;

use App\Models\AttendanceLog;
use App\Models\Employee;
use App\Models\VariableAllowance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class VariableAllowanceService
{
    public function getAllEmployeeAllowances()
    {
        $startDate = Carbon::now()->subMonth()->format('Y-m-29');
        $endDate = Carbon::now()->format('Y-m-28');
        $allowances = Employee::with('variableAllowance')->withSum(
            ['attendanceLogs' => function ($query) use($startDate, $endDate) {return $query->where('tanggal_expired', '>=', date('Y-m-d'));}], 
            'total_jam'
        )->get();
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $allowances
        ];
    }
    public function addAllowance($attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required|numeric',
            'gaji_pokok' => 'required|numeric',
            'tunjangan_jabatan' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        if (VariableAllowance::where('employee_nip', $attr['nip'])->count() > 0) {
            return [
                'code' => 400,
                'message' => 'Karyawan sudah mempunyai tunjangan tidak tetap, silahkan gunakan fitur Edit'
            ];
        }
        $allowance = VariableAllowance::create([
            'employee_nip' => $attr['nip'],
            'gaji_pokok' => $attr['gaji_pokok'],
            'tunjangan_jabatan' => $attr['tunjangan_jabatan'],
            'perjam' => ((int)$attr['gaji_pokok'] + (int)$attr['tunjangan_jabatan']) / 182 /* TODO: make trigger for this */
        ]);
        return [
            'code' => 201,
            'message' => 'Tunjangan berhasil ditambah',
            'data' => $allowance
        ];
    }
    public function show($nip)
    {
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => VariableAllowance::where('employee_nip', $nip)->first()
        ];
    }
    public function delete($nip)
    {
        $variableAllowance = VariableAllowance::where('employee_nip', $nip)->first();
        if ($variableAllowance->delete()) 
        {
            return [
                'code' => 204,
                'message' => 'Data berhasil dihapus'
            ];
        }
    }
    public function updateAllowance($nip, $attr)
    {
        $validator = Validator::make($attr, [
            'gaji_pokok' => 'required|numeric',
            'tunjangan_jabatan' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $allowance = VariableAllowance::where('employee_nip', $nip)->first();
        $allowance->gaji_pokok = $attr['gaji_pokok'];
        $allowance->tunjangan_jabatan = $attr['tunjangan_jabatan'];
        $allowance->perjam = ((int)$attr['gaji_pokok'] + (int)$attr['tunjangan_jabatan']) / 182; /* TODO: make triggers for this */
        if ($allowance->save()) {
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil diubah'
            ];
        }
    }
    public function uploadWorkPresence()
    {
        return 'UPLOAD DATA EXCEL';
    }
    public function showWorkPresence($nip)
    {
        $startDate = Carbon::now()->subMonth()->format('Y-m-29');
        $endDate = Carbon::now()->format('Y-m-28');
        $logs = AttendanceLog::where('employee_nip', $nip)->where('tanggal_expired', '>=', date('Y-m-d'))->get();
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $logs
        ];
    }
    public function printPresence($nip)
    {
        $startDate = Carbon::now()->subMonth()->format('Y-m-29');
        $endDate = Carbon::now()->format('Y-m-28');
        $logs = AttendanceLog::where('employee_nip', $nip)->where('tanggal_expired', '>=', date('Y-m-d'))->get(['tanggal', 'total_jam']);
        $employee = Employee::where('nip', $nip)->first()->load('variableAllowance');
        return [
            'logs' => $logs,
            'employee' => $employee
        ];
    }
}