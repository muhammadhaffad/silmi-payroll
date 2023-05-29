<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceLogExport;
use App\Exports\SalaryKhususExport;
use App\Exports\SalaryNonKhususExport;
use App\Models\AttendanceLog;
use App\Services\Salary\SalaryService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use transloadit\Transloadit;

class SalaryController extends Controller
{
    protected $salaryService;
    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }
    public function index(Request $request)
    {
        $result = $this->salaryService->getAllEmployeeSalaries($request->all());
        // dd($result);
        return view('gaji-pegawai.gaji.index', [
            'salaries' => $result['data']
        ]);
    }
    public function printSalaryPDF($nip, Request $request)
    {
        $result = $this->salaryService->getEmployeeSalaryThisMonth($nip, $request->all());
        if ($result['data']->is_khusus) {
            return Excel::download(new SalaryKhususExport($result['data']), sprintf("gaji_%s_%u_%u.pdf", $result['data']->nama, request()->year ?? date('Y'), request()->month ?? date('m')), 'Mpdf');
        } else {
            return Excel::download(new SalaryNonKhususExport($result['data']), sprintf("gaji_%s_%u_%u.pdf", $result['data']->nama, request()->year ?? date('Y'), request()->month ?? date('m')), 'Mpdf');
        }
    }
    public function printSalaryImage($nip, Request $request)
    {
        $result = $this->salaryService->getEmployeeSalaryThisMonth($nip, $request->all());
        if ($result['data']->is_khusus) {
            file_put_contents('gaji.pdf', Excel::raw(new SalaryKhususExport($result['data']), 'Mpdf'));
            exec('magick -density 144 gaji.pdf gaji.jpg');
            return response()->download('gaji.jpg', sprintf("gaji_%s_%u_%u.pdf", $result['data']->nama, request()->year ?? date('Y'), request()->month ?? date('m')), [], 'inline');
        } else {
            file_put_contents('gaji.pdf', Excel::raw(new SalaryNonKhususExport($result['data']), 'Mpdf'));
            exec('magick -density 144 gaji.pdf gaji.jpg');
            return response()->download('gaji.jpg', sprintf("gaji_%s_%u_%u.pdf", $result['data']->nama, request()->year ?? date('Y'), request()->month ?? date('m')), [], 'inline');
        }
    }
    public function printLog($nip, Request $request)
    {
        $result = $this->salaryService->getEmployeeLogThisMonth($nip, $request->all());
        file_put_contents('gaji-perjam.pdf', Excel::raw(new AttendanceLogExport($result), 'Mpdf'));
        exec('magick -density 144 gaji-perjam.pdf gaji-perjam.jpg');
        return response()->download('gaji-perjam.jpg', sprintf("gaji-perjam_%s_%u_%u.pdf", $result['employee']->nama, request()->year ?? date('Y'), request()->month ?? date('m')), [], 'inline');
    }
}
