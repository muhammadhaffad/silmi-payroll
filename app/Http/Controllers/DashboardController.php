<?php

namespace App\Http\Controllers;

use App\Services\Employee\EmployeeService;
use App\Services\Report\ReportService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $employeeService;
    protected $reportService;
    public function __construct(EmployeeService $employeeService, ReportService $reportService)
    {
        $this->employeeService = $employeeService;
        $this->reportService = $reportService;
    }
    public function index(Request $request) 
    {
        $employees = $this->employeeService->getAllEmployees();
        $gender = $this->employeeService->countGenderEmployee();
        $annualSalary = $this->reportService->getAnnualDevisionSalary($request->tahun);
        // dd($annualSalary);
        return view('gaji-pegawai.dashboard.index', [
            'employees' => $employees['data'],
            'gender' => $gender['data'],
            'annualSalary' => $annualSalary['data']
        ]);
    }
}
