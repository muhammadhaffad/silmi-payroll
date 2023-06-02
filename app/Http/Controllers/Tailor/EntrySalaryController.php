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
    public function addSewingTask($id, Request $request)
    {
        $result = $this->entrySalaryService->addSewingTask($id, $request->all());
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
    public function addSewingDefect($id, Request $request)
    {
        $result = $this->entrySalaryService->addOrUpdateDefect($id, $request->all());
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
    public function addSewingNeed($id, Request $request)
    {
        $result = $this->entrySalaryService->addSewingNeed($id, $request->all());
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
    public function saveTrimming($id, Request $request)
    {
        $result = $this->entrySalaryService->updateTrimming($id, $request->all());
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
    public function saveInstallment($id, Request $request)
    {
        $result = $this->entrySalaryService->updateInstallment($id, $request->all());
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
    public function saveInfaq($id, Request $request)
    {
        $result = $this->entrySalaryService->updateInfaq($id, $request->all());
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
