<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Services\TailorCompensationSetting\CompensationSettingService;
use App\Services\TailorEmployee\EmployeeService;
use Illuminate\Http\Request;

class CompensationSettingController extends Controller
{
    protected $compensationSettingService;
    public function __construct(CompensationSettingService $compensationSettingService)
    {
        $this->compensationSettingService = $compensationSettingService;
    }
    public function index()
    {
        return view('gaji-penjahit.kompensasi-total-jahit.index');
    }
    public function show($id)
    {
        $result = $this->compensationSettingService->getEmployeeCompensationSettings($id);
        if ($result['code'] == 404) {
            return abort(404);
        }
        return view('gaji-penjahit.kompensasi-total-jahit.edit', ['employee' => $result['data']]);
    }
    public function create($id, Request $request)
    {
        $result = $this->compensationSettingService->addCompensationRule($id, $request->all());
        if ($result['code'] == 422) {
            return redirect()->back()->with('errors', $result['message']);
        }
        if ($result['code'] == 404) {
            return abort(404);
        }
        if ($result['code'] == 201) {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function update($id, Request $request)
    {
        $result = $this->compensationSettingService->updateCompensationRule($id, $request->all());
        if ($result['code'] == 422) {
            return redirect()->back()->with('errors', $result['message']);
        }
        if ($result['code'] == 404) {
            return abort(404);
        }
        if ($result['code'] == 204) {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function remove($id, Request $request)
    {
        $result = $this->compensationSettingService->removeCompensationRule($id);
        if ($result['code'] == 422) {
            return redirect()->back()->with('errors', $result['message']);
        }
        if ($result['code'] == 404) {
            return abort(404);
        }
        if ($result['code'] == 204) {
            return redirect()->back()->with('success', $result['message']);
        }
    }
}
