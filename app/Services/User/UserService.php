<?php
namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService 
{
    public function getAllUsers()
    {
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => User::all()
        ];
    }
    public function chagePasswordUser($id, $attr) 
    {
        $validator = Validator::make($attr, [
            'new_password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $user = User::find($id);
        $user->password = Hash::make($attr['new_password']);
        if ($user->save()) {
            return [
                'code' => 204,
                'message' => "Password berhasil diupdate"
            ];
        }
    }
}