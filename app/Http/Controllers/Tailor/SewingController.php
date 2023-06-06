<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Imports\SewingDataMasterImport;
use App\Services\TailorSewing\SewingService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SewingController extends Controller
{
    protected $sewingService;
    public function __construct(SewingService $sewingService)
    {
        $this->sewingService = $sewingService;
    }
    public function index()
    {
        $result = $this->sewingService->getAllSewings();
        return view('gaji-penjahit.jahit.index', ['sewings' => $result['data']]);
    }
    public function update($id, Request $request)
    {
        $result = $this->sewingService->updateSewing($id, $request->all());
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
    public function create(Request $request)
    {
        $result = $this->sewingService->addSewing($request->all());
        if ($result['code'] == 422) {
            return redirect()->back()->with('errors', $result['message']);
        } else {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function delete($id, Request $request)
    {
        $result = $this->sewingService->removeSewing($id);
        if ($result['code'] == 422) {
            return redirect()->back()->with('errors', $result['message']);
        } else {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function import(Request $request)
    {
        Excel::import(new SewingDataMasterImport, $request->file('file'));
    }
}
