<?php
namespace App\Services\Director;

use App\Models\Director;
use Illuminate\Support\Facades\Validator;

class DirectorService
{
    public function getAllDirectors()
    {
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => Director::all()
        ];
    }
    public function getDirector($id)
    {
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => Director::find($id)
        ];
    }
    public function addDirector($attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'gaji' => 'required|numeric',
            'gaji_tambahan' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $director = Director::create([
            'nama' => $attr['nama'],
            'jenis_kelamin' => $attr['jenis_kelamin'],
            'gaji' => $attr['gaji'],
            'gaji_tambahan' => $attr['gaji_tambahan'],
        ]);
        return [
            'code' => 201,
            'message' => 'Direksi berhasil ditambahkan',
            'data' => $director
        ];
    }
    public function updateDirector($id, $attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'gaji' => 'required|numeric',
            'gaji_tambahan' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $director = Director::find($id);
        $director->nama = $attr['nama'];
        $director->jenis_kelamin = $attr['jenis_kelamin'];
        $director->gaji = $attr['gaji'];
        $director->gaji_tambahan = $attr['gaji_tambahan'];
        if ($director->save()) {
            return [
                'code' => 204,
                'message' => "Data berhasil diupdate"
            ];
        }
    }
    public function deleteDirector($id)
    {
        $director = Director::find($id)->delete();
        if ($director) {
            return [
                'code' => 204,
                'message' => 'Direksi berhasil dihapus'
            ];
        }
        return [
            'code' => 400,
            'message' => 'Direksi tidak ditemukan'
        ];
    }
}