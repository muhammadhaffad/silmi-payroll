<?php

namespace App\Http\Controllers\Tailor;

use App\Exports\TailorReportExport;
use App\Http\Controllers\Controller;
use App\Services\TailorReport\ReportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function makeReport()
    {
        $result = $this->reportService->makeReport();
        return redirect()->back()->with('success', $result['message']);
    }
    public function getReport(Request $request)
    {
        $result = $this->reportService->getReport($request->all());
        if ($result['code'] == 200) {
            return Excel::download(new TailorReportExport($result['data']), 'test-report', 'Mpdf');
        } else {
            return abort(404);
        }
    }
}
