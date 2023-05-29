<?php

namespace App\Http\Controllers;

use App\Exports\DebtExport;
use App\Services\Debt\DebtService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class DebtController extends Controller
{
    protected $debtService;
    public function __construct(DebtService $debtService)
    {
        $this->debtService = $debtService;
    }
    public function index()
    {
        $result = $this->debtService->getAllEmployeeDebts();
        return view('gaji-pegawai.kartu-cicilan.index', [
            'debts' => $result['data']
        ]);
    }
    public function addDebt(Request $request)
    {
        $result = $this->debtService->createDebt($request->all());
        if ($result['code'] == 201) {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function payDebt(Request $request)
    {
        $result = $this->debtService->payDebt($request->all());
        if ($result['code'] == 201) {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function removeDebtPayment($id)
    {
        $result = $this->debtService->deleteDebtPayment($id);
        if ($result['code'] == 204) {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function removeDebt($id)
    {
        $result = $this->debtService->deleteDebt($id);
        if ($result['code'] == 204) {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function printDebt($id)
    {
        $result = $this->debtService->getDebt($id);
        // return $result;
        return Excel::download(new DebtExport($result['data']), sprintf('cicilan_%s_%s.pdf', $result['data']->employee->nama, $result['data']->tanggal), ExcelExcel::MPDF);
    }
    public function copyDebt($id)
    {
        $result = $this->debtService->getDebt($id);
        // return $result;
        file_put_contents('cicilan.pdf', Excel::raw(new DebtExport($result['data']), 'Mpdf'));
        exec('magick -density 144 cicilan.pdf cicilan.jpg');
        return response()->download('cicilan.jpg', sprintf('cicilan_%s_%s.pdf', $result['data']->employee->nama, $result['data']->tanggal), [], 'inline');
    }
}
