<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $result = $this->userService->getAllUsers();
        return view('gaji-pegawai.user.index', [
            'users' => $result['data']
        ]);
    }

    public function changePassword($id, Request $request)
    {
        $result = $this->userService->chagePasswordUser($id, $request->all());
        if ($result['code'] == 422)
            return redirect()->back()->withErrors($result['errors']);
        if ($result['code'] == 204)
            return redirect()->back()->with('success', $result['message']);
    }
}
