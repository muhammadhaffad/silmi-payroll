<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Services\TailorReport\ReportService;
use Illuminate\Http\Request;

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
}
