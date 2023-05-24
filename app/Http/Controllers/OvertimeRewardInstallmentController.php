<?php

namespace App\Http\Controllers;

use App\Imports\FixedAllowanceImport;
use App\Services\Allowance\FixedAllowanceService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OvertimeRewardInstallmentController extends Controller
{
    protected $fixedAllowanceService;
    public function __construct(FixedAllowanceService $fixedAllowanceService)
    {
        return $this->fixedAllowanceService = $fixedAllowanceService;
    }
    public function index()
    {
        $result = $this->fixedAllowanceService->getAllEmployeeSomeAllowances(['overtimes', 'rewards', 'installments']);
        return view('gaji-pegawai.lembur-reward-cicilan.index', [
            'employees' => $result['data']
        ]);
    }
    public function remove($nip)
    {
        $result = $this->fixedAllowanceService->deleteSomeAllowances($nip, ['overtimes', 'rewards', 'installments']);
        return redirect()->back()->with('success', $result['message']);
    }
    public function edit($nip)
    {

    }
    /* public function update($nip, Request $request)
    {
        $result = $this->fixedAllowanceService->updateAllowance($nip, 'reward', 1, $request->all());
        if ($result['code'] == 422) {
            return redirect()->back()->with('error', $result['message']);
        }
        $result = $this->fixedAllowanceService->updateAllowance($nip, 'lembur', 1, $request->all());
        if ($result['code'] == 422) {
            return redirect()->back()->with('error', $result['message']);
        }
        $result = $this->fixedAllowanceService->updateAllowance($nip, 'cicilan', 1, $request->all());
        if ($result['code'] == 422) {
            return redirect()->back()->with('error', $result['message']);
        }
        return redirect()->back()->with('success', $result['message']);
    } */
    public function removeAll()
    {
        $result = $this->fixedAllowanceService->deleteAllEmployeeSomeAllowances(['Overtime', 'Reward', 'Installment']);
        return redirect()->back()->with('success', $result['message']);
    }
    public function uploadData(Request $request)
    {
        Excel::import(new FixedAllowanceImport, $request->file('file'));
        return redirect()->back()->with('success', 'File excel berhasil diupload');
    }
}
