<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Services\TailorEntrySalary\EntrySalaryService;
use Illuminate\Http\Request;

class EntrySalaryController extends Controller
{
    protected $entrySalaryService;
    public function __construct(EntrySalaryService $entrySalaryService)
    {
        $this->entrySalaryService = $entrySalaryService;
    }
    public function index()
    {
        $result = $this->entrySalaryService->getAllEmployeeSalaries();
        return view('gaji-penjahit.entri-data-gaji.index', ['employees' => $result['data']]);
    }
}
