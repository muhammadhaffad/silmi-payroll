<?php

namespace App\Http\Controllers;

use App\Services\Allowance\FixedAllowanceService;
use Illuminate\Http\Request;

class FixedAllowanceController extends Controller
{
    protected $fixedAllowanceService;
    public function __construct(FixedAllowanceService $fixedAllowanceService)
    {
        $this->fixedAllowanceService = $fixedAllowanceService;
    }
    public function index()
    {
        $result = $this->fixedAllowanceService->getAllEmployeeAllowances();
        return view('gaji-pegawai.tunjangan-tetap.index', [
            'allowances' => $result['data']
        ]);
    }
    public function show($nip)
    {
        $result = $this->fixedAllowanceService->getEmployeeAllowance($nip);
        return view('gaji-pegawai.tunjangan-tetap.show', [
            'allowance' => $result['data']
        ]);
    }
    public function addAllowance(Request $request)
    {
        $result = $this->fixedAllowanceService->addAllowance($request->all());
        if ($result['code'] == 204)
            return redirect()->back()->with('success', $result['message']);
        if ($result['code'] == 400)
            return redirect()->back()->with('error', $result['message']);
        if ($result['code'] == 422)
            return redirect()->back()->with('error', $result['message']);
    }
}
