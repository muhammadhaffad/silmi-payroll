<?php
namespace App\Services\Salary;

use App\Models\AttendanceLog;
use App\Models\Employee;
use App\Models\Report;
use Carbon\Carbon;

class SalaryService
{
    public function getAllEmployeeSalaries($attr)
    {
        $year = $attr['year'] ?? date('Y');
        $month = $attr['month'] ?? date('m');
        $date = Carbon::now()->subMonth()->format("$year-$month-01");
        $salaries = Report::where('tanggal', $date)->get();
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => $salaries
        ];
    }
    /* public function getAllEmployeeSalaries()
    {
        $startDate = Carbon::now()->subMonth()->format('Y-m-29');
        $endDate = Carbon::now()->format('Y-m-28');
        $salaries = Employee::with(['fixedAllowance', 'variableAllowance'])
            ->withSum(['attendanceLogs' => function ($query) use ($startDate, $endDate) {
                $query->where('tanggal_expired', '>=', date('Y-m-d'));
            }], 'total_jam')->get();
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => $salaries
        ];
    } */
    public function getEmployeeSalaryThisMonth($nip, $attr)
    {
        $year = $attr['year'] ?? date('Y');
        $month = $attr['month'] ?? date('m');
        $report = Report::where('nip', $nip)->where('tanggal', "$year-$month-01")->first();
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => $report
        ];
    }
    public function getEmployeeLogThisMonth($nip, $attr)
    {
        $year = $attr['year'] ?? date('Y');
        $month = $attr['month'] ?? date('m');
        $startDate = Carbon::parse("$year-$month-01")->subMonth()->format('Y-m-29');
        $endDate = Carbon::parse("$year-$month-01")->format('Y-m-28');
        $logs = AttendanceLog::where('employee_nip', $nip)->where('tanggal', '>=', $startDate)->where('tanggal', '<=', $endDate)->get(['tanggal', 'total_jam']);
        $employee = Employee::where('nip', $nip)->first()->load('variableAllowance');
        return [
            'logs' => $logs,
            'employee' => $employee
        ];
    }
}