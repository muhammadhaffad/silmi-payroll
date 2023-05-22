<?php
namespace App\Services\Employee;

use App\Models\Employee;

class EmployeeService
{
    public function getAllEmployees()
    {
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => Employee::all()
        ];
    }
    public function addEmployee($attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required|numeric',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'devisi' => 'required',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $employee = Employee::create([
            'nip' => $attr['nip'],
            'nama' => $attr['nama'],
            'jenis_kelamin' => $attr['jenis_kelamin'],
            'tanggal_lahir' => $attr['tanggal_lahir'],
            'devisi' => $attr['devisi'],
            'jabatan' => $attr['jabatan'],
            'tanggal_masuk' => $attr['tanggal_masuk'],
            'alamat' => $attr['alamat'],
            'is_khusus' => false,
            'status' => true
        ]);
        return [
            'code' => 201,
            'message' => 'Karyawan berhasil ditambah',
            'data' => $employee
        ];
    }
    public function updateEmployee($id, $attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required|numeric',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'devisi' => 'required',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $employee = Employee::find($id);
        $employee->nip = $attr['nip'];
        $employee->nama = $attr['nama'];
        $employee->jenis_kelamin = $attr['jenis_kelamin'];
        $employee->tanggal_lahir = $attr['tanggal_lahir'];
        $employee->devisi = $attr['devisi'];
        $employee->jabatan = $attr['jabatan'];
        $employee->tanggal_masuk = $attr['tanggal_masuk'];
        $employee->alamat = $attr['alamat'];
        if ($employee->save()) {
            return [
                'code' => 204,
                'message' => 'Data karyawan berhasil diubah'
            ];
        }
    }
    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);
        if ($employee->delete()) {
            return [
                'code' => 204,
                'message' => 'Data karyawan berhasil dihapus',
            ];
        }
    }
    public function toggleKhusus($id)
    {
        $employee = Employee::find($id);
        if ($employee->is_khusus) {
            $employee->is_khusus = false;
        } else {
            $employee->is_khusus = true;
        }
        if ($employee->save()) {
            return [
                'code' => 204,
                'message' => 'Tipe karyawan berhasil diubah'
            ];
        }
    }
    public function toggleStatus($id)
    {
        $employee = Employee::find($id);
        if ($employee->status) {
            $employee->status = false;
        } else {
            $employee->status = true;
        }
        if ($employee->save()) {
            return [
                'code' => 204,
                'message' => 'Status karyawan berhasil diubah'
            ];
        }
    }
}