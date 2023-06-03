<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Services\TailorCompensationSetting\CompensationSettingService;
use Illuminate\Http\Request;

class DefectSettingController extends Controller
{
    protected $compensationSettingService;
    public function __construct(CompensationSettingService $compensationSettingService)
    {
        $this->compensationSettingService = $compensationSettingService;
    }
    public function index()
    {
        $result = $this->compensationSettingService->getDefectRule();
        return view('gaji-penjahit.kompensasi-kasus.index', ['defectRules' => $result['data']]);
    }
    public function create(Request $request)
    {
        $result = $this->compensationSettingService->addDefectRule($request->all());
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
        $result = $this->compensationSettingService->updateDefectRule($id, $request->all());
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
        $result = $this->compensationSettingService->removeDefectRule($id);
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
