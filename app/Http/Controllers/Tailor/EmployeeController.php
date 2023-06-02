<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Services\TailorEmployee\EmployeeService;
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
        return view('gaji-penjahit.karyawan.index', ['employees' => $result['data']]);
    }
    public function update($id, Request $request)
    {
        $result = $this->employeeService->updateEmployee($id, $request->all());
        if ($result['code'] == 204) {
            return redirect()->back()->with('success', $result['message']);
        }
        if ($result['code'] == 404) {
            return abort(404);
        }
        if ($result['code'] == 422) {
            return redirect()->back()->with('errors', $result['message']);
        }
    }
    public function create(Request $request)
    {
        $result = $this->employeeService->createEmployee($request->all());
        return redirect()->back()->with('success', $result['message']);
    }
}
