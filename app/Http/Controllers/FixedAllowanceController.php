<?php

namespace App\Http\Controllers;

use App\Services\Allowance\FixedAllowanceService;
use Illuminate\Http\Request;

class FixedAllowanceController extends Controller
{
    protected $fixedAllowanceService;
    public function __construct(FixedAllowanceService $fixedAllowanceService)
    {
        $this->fixedAllowanceService = $fixedAllowanceService;
    }
    public function index()
    {
        $result = $this->fixedAllowanceService->getAllEmployeeAllowances();
        return view('gaji-pegawai.tunjangan-tetap.index', [
            'allowances' => $result['data']
        ]);
    }
    public function show($nip)
    {
        $result = $this->fixedAllowanceService->getEmployeeAllowance($nip);
        return view('gaji-pegawai.tunjangan-tetap.show', [
            'allowance' => $result['data']
        ]);
    }
    public function addAllowance(Request $request)
    {
        $result = $this->fixedAllowanceService->addAllowance($request->all());
        if ($result['code'] == 204)
            return redirect()->back()->with('success', $result['message']);
        if ($result['code'] == 400)
            return redirect()->back()->with('error', $result['message']);
        if ($result['code'] == 422)
            return redirect()->back()->with('error', $result['message']);
    }
    public function edit($nip, $tunjangan, $id)
    {
        $result = $this->fixedAllowanceService->show($nip, $tunjangan, $id);
        switch ($tunjangan) {
            case 'keahlian':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Tunjangan Keahlian', 'data' => $result['data']]);
                break;
            case 'kepala-keluarga':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Tunjangan Kepala Keluarga', 'data' => $result['data']]);
                break;
            case 'masa-kerja':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Tunjangan Masa Kerja', 'data' => $result['data']]);
                break;
            case 'operasional':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Tunjangan Operasional', 'data' => $result['data']]);
                break;
            case 'lain-lain':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Tunjangan Lain-lain', 'data' => $result['data']]);
                break;
            case 'reward':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Tunjangan Reward', 'data' => $result['data']]);
                break;
            case 'lembur':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Tunjangan Lembur', 'data' => $result['data']]);
                break;
            case 'infaq':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Infaq', 'data' => $result['data']]);
                break;
            case 'cicilan':
                return view('gaji-pegawai.tunjangan-tetap.edit', [ 'nip'=> $nip, 'tunjangan' => $tunjangan, 'id' => $id, 'title' => 'Cicilan', 'data' => $result['data']]);
                break;
            default:
                return abort(404);
                break;
        }
    }
    public function update($nip, $tunjangan, $id, Request $request)
    {
        $result = $this->fixedAllowanceService->updateAllowance($nip, $tunjangan, $id, $request->all());
        if ($result['code'] == 204)
            return redirect()->back()->with('success', $result['message']);
        if ($result['code'] == 422)
            return redirect()->back()->with('error', $result['message']);
        if ($result['code'] == 400)
            return redirect()->back()->with('error', $result['message']);
    }
    public function remove($nip, $tunjangan, $id)
    {
        $result = $this->fixedAllowanceService->deleteAllowance($nip, $tunjangan, $id);
        if ($result['code'] == 204)
            return redirect()->back()->with('success', $result['message']);
        if ($result['code'] == 400)
            return redirect()->back()->with('error', $result['message']);
    }
}
