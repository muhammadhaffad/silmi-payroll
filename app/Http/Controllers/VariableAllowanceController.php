<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceLogExport;
use App\Imports\AttendanceLogsImport;
use App\Services\Allowance\VariableAllowanceService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as MaatwebsiteExcel;
use Maatwebsite\Excel\Facades\Excel;

class VariableAllowanceController extends Controller
{
    protected $variableAllowanceService;
    public function __construct(VariableAllowanceService $variableAllowanceService)
    {
        $this->variableAllowanceService = $variableAllowanceService;
    }
    public function index()
    {
        $result = $this->variableAllowanceService->getAllEmployeeAllowances();
        return view('gaji-pegawai.tunjangan-tidak-tetap.index', ['employees' => $result['data']]);
    }
    public function edit($nip)
    {
        $result = $this->variableAllowanceService->show($nip);
        return view('gaji-pegawai.tunjangan-tidak-tetap.edit', ['nip' => $nip, 'allowance' => $result['data']]);
    }
    public function update($nip, Request $request)
    {
        $result = $this->variableAllowanceService->updateAllowance($nip, $request->all());
        if ($result['code'] == 422)
            return redirect()->back()->with('error', $result['message']);
        if ($result['code'] == 204)
            return redirect()->back()->with('success', $result['message']);
    }
    public function remove($nip) {
        $result = $this->variableAllowanceService->delete($nip);
        if ($result['code'] == 204) {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function addAllowance(Request $request)
    {
        $result = $this->variableAllowanceService->addAllowance($request->all());
        if ($result['code'] == 201) {
            return redirect()->back()->with('success', $result['message']);
        }
        if ($result['code'] == 422) {
            return redirect()->back()->with('error', $result['message']);
        }
        if ($result['code'] == 400) {
            return redirect()->back()->with('error', $result['message']);
        }
    }
    public function showAttendance($nip)
    {
        $result = $this->variableAllowanceService->showWorkPresence($nip);
        return view('gaji-pegawai.tunjangan-tidak-tetap.show', ['nip' => $nip, 'attendances' => $result['data']]);
    }
    public function uploadLog(Request $request)
    {
        Excel::import(new AttendanceLogsImport, $request->file('file'));
        return redirect()->back()->with('success', 'File excel berhasil diupload');
    }
    public function downloadLog($nip)
    {
        $result = $this->variableAllowanceService->printPresence($nip);
        return Excel::download(new AttendanceLogExport($result), 'log.pdf', MaatwebsiteExcel::MPDF);
    }
}
