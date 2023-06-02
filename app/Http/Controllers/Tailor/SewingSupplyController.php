<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Services\TailorSewing\SewingService;
use Illuminate\Http\Request;

class SewingSupplyController extends Controller
{
    protected $sewingService;
    public function __construct(SewingService $sewingService)
    {
        $this->sewingService = $sewingService;
    }
    public function index()
    {
        $result = $this->sewingService->getAllSewingSupplies();
        return view('gaji-penjahit.kebutuhan-jahit.index', ['sewingSupplies' => $result['data']]);
    }
    public function update($id, Request $request)
    {
        $result = $this->sewingService->updateSewingSupply($id, $request->all());
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
        $result = $this->sewingService->addSewingSupply($request->all());
        if ($result['code'] == 422) {
            return redirect()->back()->with('errors', $result['message']);
        } else {
            return redirect()->back()->with('success', $result['message']);
        }
    }
    public function delete($id, Request $request)
    {
        $result = $this->sewingService->removeSewingSupply($id);
        if ($result['code'] == 422) {
            return redirect()->back()->with('errors', $result['message']);
        } else {
            return redirect()->back()->with('success', $result['message']);
        }
    }
}