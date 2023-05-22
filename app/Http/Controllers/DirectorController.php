<?php

namespace App\Http\Controllers;

use App\Services\Director\DirectorService;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    protected $directorService;
    public function __construct(DirectorService $directorService)
    {
        $this->directorService = $directorService;
    }
    public function index()
    {
        $result = $this->directorService->getAllDirectors();
        return view('gaji-pegawai.direksi.index', [
            'directors' => $result['data']
        ]);
    }
    public function store(Request $request)
    {
        $result = $this->directorService->addDirector($request->all());
        if ($result['code'] === 422)
            return redirect()->back()->with('error', $result['message']);
        if ($result['code'] === 201)
            return redirect()->back()->with('success', $result['message']);
    }
    public function remove($id)
    {
        $result = $this->directorService->deleteDirector($id);
        if ($result['code'] === 204)
            return redirect()->back()->with('success', $result['message']);
        else
            return redirect()->back()->with('error', $result['message']);
    }
    public function edit($id)
    {
        $result = $this->directorService->getDirector($id);
        return view('gaji-pegawai.direksi.edit', [
            'director' => $result['data']
        ]);
    }
    public function update($id, Request $request)
    {
        $result = $this->directorService->updateDirector($id, $request->all());
        if ($result['code'] === 204)
            return redirect()->back()->with('success', $result['message']);
        if ($result['code'] === 422)
            return redirect()->back()->with('error', $result['message']);
    }
}
