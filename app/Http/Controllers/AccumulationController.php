<?php

namespace App\Http\Controllers;

use App\Services\Report\ReportService;
use Illuminate\Http\Request;

class AccumulationController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function index(Request $request)
    {
        $result = $this->reportService->getAnnualDevisionSalary($request->tahun ?? date('Y'), true);
        return view('gaji-pegawai.akumulasi.index', ['reports' => $result['data']]);
    }
}
