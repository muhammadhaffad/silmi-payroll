<?php

namespace App\Http\Controllers\Tailor;

use App\Exports\TailorSalaryExport;
use App\Http\Controllers\Controller;
use App\Services\TailorReport\ReportService;
use Carbon\Carbon;
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
        return view('gaji-penjahit.gaji.index', ['employees' => $result['data'] ?? []]);
    }
    public function getSalaryPdf($id, Request $request)
    {
        $result = $this->reportService->getTailorReport($id, $request->all());
        return Excel::download(new TailorSalaryExport($result['data']), sprintf('gaji-penjahit-%s-%u-%u.pdf', $result['data']->nama, Carbon::parse($result['data']->tanggal)->format('Y'), Carbon::parse($result['data']->tanggal)->format('m')), 'Mpdf');
    }
    public function getSalaryJpg($id, Request $request)
    {
        $result = $this->reportService->getTailorReport($id, $request->all());
        // return Excel::download(new TailorSalaryExport($result['data']), sprintf('gaji-penjahit-%s-%u-%u.pdf', $result['data']->nama, Carbon::parse($result['data']->tanggal)->format('Y'), Carbon::parse($result['data']->tanggal)->format('m')), 'Mpdf');
        file_put_contents('gaji-penjahit.pdf', Excel::raw(new TailorSalaryExport($result['data']), 'Mpdf'));
        exec('magick -density 144 gaji-penjahit.pdf gaji-penjahit.jpg');
        return response()->download('gaji-penjahit.jpg', sprintf('gaji-penjahit-%s-%u-%u.jpg', $result['data']->nama, Carbon::parse($result['data']->tanggal)->format('Y'), Carbon::parse($result['data']->tanggal)->format('m')), [], 'inline');
    }
}
