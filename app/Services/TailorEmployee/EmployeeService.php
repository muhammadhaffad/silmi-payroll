<?php
namespace App\Services\TailorEmployee;

use App\Models\Tailor\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeService 
{
    public function getAllEmployees()
    {
        $employees = Employee::with(['infaq', 'installment', 'trimming'])->get();
        return [
            'code' => 200,
            'message' => 'Sukses mendapatkan data',
            'data' => $employees
        ];
    }
    public function createEmployee($attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'required|string'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $employee = Employee::create([
            'nama' => $attr['nama']
        ]);
        return [
            'code' => 201,
            'message' => 'Karyawan berhasil didaftarkan',
            'data' => $employee->load(['installment', 'infaq', 'trimming'])
        ];
    }
    public function updateEmployee($id, $attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'required|string',
            'jumlah_cicilan' => 'required|numeric',
            'jumlah_bubut' => 'required|numeric',
            'jumlah_infaq' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $employee = Employee::find($id);
        if (!$employee) {
            return [
                'code' => 404,
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        $employee->update([
            'nama' => $attr['nama']
        ]);
        $employee->installment()->update([
            'jumlah' => $attr['jumlah_cicilan']
        ]);
        $employee->trimming()->update([
            'jumlah' => $attr['jumlah_bubut']
        ]);
        $employee->infaq()->update([
            'jumlah' => $attr['jumlah_infaq']
        ]);
        return [
            'code' => 204,
            'message' => 'Data karyawan berhasil diupdate'
        ];
    }
    public function toggleActive($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return [
                'code' => 404,
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        if ($employee->is_active) {
            $employee->is_active = false;
            $employee->save();
        } else {
            $employee->is_active = true;
            $employee->save();
        }
    }
    public function removeEmployee($id) 
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return [
                'code' => 404,
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        $employee->delete();
        return [
            'code' => 204,
            'message' => 'Karyawan berhasil dihapus'
        ];
    }
}