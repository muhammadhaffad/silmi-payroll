<?php

namespace App\Services\TailorSewing;

use App\Models\Tailor\Employee;
use App\Models\Tailor\Sewing;
use App\Models\Tailor\SewingNeed;
use App\Models\Tailor\SewingSupply;
use App\Models\Tailor\SewingTask;
use Illuminate\Support\Facades\Validator;

class SewingService
{
    /* Sewing */
    public function getAllSewings()
    {
        $sewings = Sewing::all();
        return [
            'code' => 200,
            'message' => 'Sukses mendapatkan data',
            'data' => $sewings
        ];
    }
    public function addSewing($attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'required|string',
            'jahit' => 'required|numeric',
            'obras' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $sewing = Sewing::create([
            'nama' => $attr['nama'],
            'jahit' => $attr['jahit'],
            'obras' => $attr['obras'],
            'total' => (int)$attr['jahit'] + (int)$attr['obras']
        ]);
        return [
            'code' => 201,
            'message' => 'Data jahit berhasil ditambahkan',
            'data' => $sewing
        ];
    }
    public function updateSewing($id, $attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'required|string',
            'jahit' => 'required|numeric',
            'obras' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $sewing = Sewing::find($id);
        if (!$sewing) {
            return [
                'code' => 404,
                'message' => 'Data jahit tidak ditemukan'
            ];
        }
        $sewing->update([
            'nama' => $attr['nama'],
            'jahit' => $attr['jahit'],
            'obras' => $attr['obras'],
            'total' => (int)$attr['jahit'] + (int)$attr['obras']
        ]);
        return [
            'code' => 204,
            'message' => 'Data jahit berhasil diupdate',
        ];
    }
    public function removeSewing($id)
    {
        $sewing = Sewing::find($id);
        if (!$sewing) {
            return [
                'code' => 404,
                'message' => 'Data jahit tidak ditemukan'
            ];
        }
        $sewing->delete();
        return [
            'code' => '204',
            'message' => 'Data jahit berhasil dihapus'
        ];
    }
    /* SewingSupply */
    public function getAllSewingSupplies()
    {
        $sewingSupplies = SewingSupply::all();
        return [
            'code' => 200,
            'message' => 'Sukses mendapatkan data',
            'data' => $sewingSupplies
        ];
    }
    public function addSewingSupply($attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'required|string',
            'harga' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $sewingSupply = SewingSupply::create([
            'nama' => $attr['nama'],
            'harga' => $attr['harga']
        ]);
        return [
            'code' => 201,
            'message' => 'Data supply jahit berhasil ditambahkan',
            'data' => $sewingSupply
        ];
    }
    public function removeSewingSupply($id)
    {
        $sewing = SewingSupply::find($id);
        if (!$sewing) {
            return [
                'code' => 404,
                'message' => 'Data supply jahit tidak ditemukan'
            ];
        }
        $sewing->delete();
        return [
            'code' => '204',
            'message' => 'Data supply jahit berhasil dihapus'
        ];
    }
    public function updateSewingSupply($id, $attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'required|string',
            'harga' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $sewing = SewingSupply::find($id);
        if (!$sewing) {
            return [
                'code' => 404,
                'message' => 'Data supply jahit tidak ditemukan'
            ];
        }
        $sewing->update([
            'nama' => $attr['nama'],
            'harga' => $attr['harga']
        ]);
        return [
            'code' => 204,
            'message' => 'Data supply jahit berhasil diupdate',
        ];
    }
}
