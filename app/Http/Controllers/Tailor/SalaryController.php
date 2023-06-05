<?php

namespace App\Http\Controllers\Tailor;

use App\Exports\TailorSalaryExport;
use App\Http\Controllers\Controller;
use App\Services\TailorReport\ReportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalaryController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function index(Request $request)
    {
        $result = $this->reportService->getReport($request->all());
        // return $result;
        return view('gaji-penjahit.gaji.index', ['employees' => $result['data']]);
    }
    public function getSalaryPdf($id, Request $request)
    {
        $result = $this->reportService->getTailorReport($id, $request->all());
        return Excel::download(new TailorSalaryExport($result['data']), 'test-gaji', 'Mpdf');
    }
}
