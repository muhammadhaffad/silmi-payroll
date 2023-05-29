<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Exports\SalesReportExport;
use App\Models\Devision;
use App\Services\Report\ReportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function index()
    {
        $result = $this->reportService->getAllDevisionSalaries();
        // return response()->json($result);
        return view('gaji-pegawai.laporan.index', [
            'salaries' => $result['data']
        ]);
    }
    public function printFullReport(Request $request)
    {
        $result = $this->reportService->getReport($request->devision, $request->year, $request->month);
        if ($result['code'] == 200) {
            if ($request->devision == 'SALES') {
                return Excel::download(new SalesReportExport($request->devision, $request->month, $request->year, $result['data']), sprintf('laporan_%s_%u-%u.pdf', $request->devision, $request->year, $request->month), ExcelExcel::MPDF);
            } else {
                return Excel::download(new ReportExport($request->devision, $request->month, $request->year, $result['data']), sprintf('laporan_%s_%u-%u.pdf', $request->devision, $request->year, $request->month), ExcelExcel::MPDF);
            }
        } else {
            return 'Laporan tidak ada';
        }
    }
    public function makeReport()
    {
        $result = $this->reportService->makeReport();
        if ($result['code'] == 201) {
            return back()->with('success', $result['message']);
        }
    }
}
