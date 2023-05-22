<?php

namespace App\Http\Controllers;

use App\Services\Employee\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    public function index()
    {
        $result = $this->employeeService->getAllEmployees();
        return view('gaji-pegawai.karyawan.index', [
            'employees' => $result['data']
        ]);
    }
    public function store(Request $request)
    {
        $result = $this->employeeService->addEmployee($request->all());
        if ($result['code'] === 201)
            return redirect()->back()->with('success', $result['message']);
        if ($result['code'] === 422)
            return redirect()->back()->with('error', $result['message']);
    }
    public function edit($nip)
    {
        $result = $this->employeeService->getEmployee($nip);
        return view('gaji-pegawai.karyawan.edit', [
            'employee' => $result['data']
        ]);
    }
    public function update($nip, Request $request)
    {
        $result = $this->employeeService->updateEmployee($nip, $request->all());
        if ($result['code'] === 204)
            return redirect()->back()->with('success', $result['message']);
        if ($result['code'] === 422)
            return redirect()->back()->with('error', $result['message']);
    }
    public function remove($nip)
    {
        $result = $this->employeeService->deleteEmployee($nip);
        if ($result['code'] === 204)
            return redirect()->back()->with('success', $result['message']);
    }
    public function toggleKhusus($nip)
    {
        $result = $this->employeeService->toggleKhusus($nip);
        if ($result['code'] === 204)
            return redirect()->back()->with('success', $result['message']);
    }
    public function toggleStatus($nip)
    {
        $result = $this->employeeService->toggleStatus($nip);
        if ($result['code'] === 204)
            return redirect()->back()->with('success', $result['message']);
    }
}
