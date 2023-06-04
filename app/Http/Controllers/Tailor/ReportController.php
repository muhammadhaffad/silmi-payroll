<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Services\TailorReport\ReportService;
use Illuminate\Http\Request;

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
        return $result;
    }
}
